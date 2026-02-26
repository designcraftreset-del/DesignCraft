const fs = require('fs');
const path = require('path');

const sqlPath = process.argv[2] || path.join(__dirname, '../storage/app/xkgdykj-m1.sql');
const outDir = path.join(__dirname, '../storage/app/db-export');

if (!fs.existsSync(sqlPath)) {
  console.error('File not found:', sqlPath);
  process.exit(1);
}

const content = fs.readFileSync(sqlPath, 'utf8');

function parseValues(valsStr, numCols) {
  const rows = [];
  let i = 0;
  const len = valsStr.length;

  function skipWs() {
    while (i < len && /\s/.test(valsStr[i])) i++;
  }

  while (i < len) {
    skipWs();
    if (valsStr[i] !== '(') break;
    i++;
    const row = [];
    for (let c = 0; c < numCols; c++) {
      skipWs();
      if (i >= len) break;
      if (valsStr.substr(i, 4) === 'NULL' && (i + 4 >= len || /[,\)]/.test(valsStr[i + 4]))) {
        row.push(null);
        i += 4;
      } else if (valsStr[i] === "'") {
        i++;
        let s = '';
        while (i < len) {
          if (valsStr[i] === '\\' && i + 1 < len) {
            s += valsStr[i + 1];
            i += 2;
            continue;
          }
          if (valsStr[i] === "'") {
            i++;
            break;
          }
          s += valsStr[i];
          i++;
        }
        row.push(s);
      } else {
        const start = i;
        while (i < len && valsStr[i] !== ',' && valsStr[i] !== ')') i++;
        let v = valsStr.slice(start, i).trim();
        row.push(v === '' ? null : (/^\d+$/.test(v) ? parseInt(v, 10) : /^\d+\.\d+$/.test(v) ? parseFloat(v) : v));
      }
      skipWs();
      if (valsStr[i] === ',') i++;
    }
    if (row.length === numCols) rows.push(row);
    skipWs();
    if (valsStr[i] === ')') i++;
    skipWs();
    if (valsStr[i] === ',') i++;
  }
  return rows;
}

const re = /INSERT INTO\s+`([^`]+)`\s*\(([^)]+)\)\s*VALUES\s*([\s\S]+?)(?=;\s*(\n|$)|(\n\s*--)|(\n\s*INSERT INTO))/gm;
let m;
const tables = [];

while ((m = re.exec(content)) !== null) {
  const table = m[1];
  const colsStr = m[2];
  const valsStr = m[3].trim();
  const columns = colsStr.split(',').map(c => c.trim().replace(/^`|`$/g, ''));
  const rows = parseValues(valsStr, columns.length);
  if (rows.length === 0) continue;
  const data = rows.map(row => {
    const obj = {};
    columns.forEach((col, i) => { obj[col] = row[i]; });
    return obj;
  });
  tables.push({ table, data });
}

if (!fs.existsSync(outDir)) fs.mkdirSync(outDir, { recursive: true });

let total = 0;
for (const { table, data } of tables) {
  const outPath = path.join(outDir, table + '.json');
  fs.writeFileSync(outPath, JSON.stringify(data, null, 2), 'utf8');
  console.log(table + ': ' + data.length + ' rows -> ' + outPath);
  total += data.length;
}
console.log('Total rows:', total);
console.log('Run: php artisan db:import --force (with .env pointing to target DB)');

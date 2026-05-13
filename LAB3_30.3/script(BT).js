function addSection(title, content, headingLevel = 'h3') {
  const out = document.getElementById('output');
  if (!out) return;
  const h = document.createElement(headingLevel);
  h.textContent = title;
  out.appendChild(h);
  const pre = document.createElement('pre');
  pre.textContent = content;
  out.appendChild(pre);
}

// ============================================================
// CÂU 1: Sinh ngẫu nhiên mảng 20 số nguyên từ 1 đến 100
// ============================================================
function generateArray(size = 20, min = 1, max = 100) {
  const arr = [];
  for (let i = 0; i < size; i++)
    arr.push(Math.floor(Math.random() * (max - min + 1)) + min);
  return arr;
}

// ============================================================
// CÂU 2: Tính tổng các phần tử trong mảng
// ============================================================
function sumArray(arr) {
  return arr.reduce((s, x) => s + x, 0);
}

// ============================================================
// CÂU 3: Sắp xếp Bubble Sort tăng / giảm dần
// ============================================================
function bubbleSort(arr) {
  const a = [...arr], n = a.length;
  for (let i = 0; i < n - 1; i++)
    for (let j = 0; j < n - i - 1; j++)
      if (a[j] > a[j + 1]) [a[j], a[j + 1]] = [a[j + 1], a[j]];
  return a;
}

// ============================================================
// CÂU 4: Tìm kiếm nhị phân
// ============================================================
function binSearch(sortedArr, x) {
  let left = 0, right = sortedArr.length - 1;
  while (left <= right) {
    const mid = Math.floor((left + right) / 2);
    if (sortedArr[mid] === x) return mid;
    else if (sortedArr[mid] < x) left = mid + 1;
    else right = mid - 1;
  }
  return -1;
}

// ============================================================
// CÂU 5: Tứ phân vị (Quartile)
// ============================================================
function findQuartile(sortedArr, x) {
  const idx = binSearch(sortedArr, x);
  if (idx === -1) return `${x} không tồn tại trong mảng đã sắp xếp ở câu 3`;
  const q = Math.floor(idx / (sortedArr.length / 4)) + 1;
  return `Phần tử ${x} ở index ${idx} → Q${q}`;
}

// ============================================================
// CÂU 6: Shuffle (Fisher-Yates)
// ============================================================
function shuffle(arr) {
  const a = [...arr];
  for (let i = a.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [a[i], a[j]] = [a[j], a[i]];
  }
  return a;
}

// ============================================================
// CÂU 7: Thống kê
// ============================================================
function calcMin(arr)      { return arr.reduce((m, x) => x < m ? x : m, arr[0]); }
function calcMax(arr)      { return arr.reduce((m, x) => x > m ? x : m, arr[0]); }
function calcMean(arr)     { return arr.reduce((s, x) => s + x, 0) / arr.length; }
function calcMedian(arr)   { const s = bubbleSort(arr), n = s.length; return n % 2 === 1 ? s[Math.floor(n / 2)] : (s[n / 2 - 1] + s[n / 2]) / 2; }
function calcVariance(arr) { const m = calcMean(arr); return arr.reduce((s, x) => s + (x - m) ** 2, 0) / arr.length; }
function statistics(arr)   { const v = calcVariance(arr); return { min: calcMin(arr), max: calcMax(arr), mean: calcMean(arr), median: calcMedian(arr), variance: v, stdDev: Math.sqrt(v) }; }

// ============================================================
// CÂU 8: Histogram
// ============================================================
function histogram(arr, numBins = 10) {
  const min = calcMin(arr), max = calcMax(arr), width = (max - min) / numBins;
  const bins = Array.from({ length: numBins }, (_, i) => {
    const lo = +(min + i * width).toFixed(2), hi = +(min + (i + 1) * width).toFixed(2);
    return { range: `[${lo}, ${hi}${i === numBins - 1 ? ']' : ')'}`, count: 0 };
  });
  for (const x of arr) bins[Math.min(Math.floor((x - min) / width), numBins - 1)].count++;
  return bins;
}

// ============================================================
// CÂU 9: Loại outliers 10%
// ============================================================
function removeOutliers(arr, percent = 0.1) {
  const mean = calcMean(arr), rc = Math.floor(arr.length * percent);
  const removeSet = new Set(
    arr.map((v, i) => ({ v, i, d: Math.abs(v - mean) }))
       .sort((a, b) => b.d - a.d)
       .slice(0, rc)
       .map(x => x.i)
  );
  return { filtered: arr.filter((_, i) => !removeSet.has(i)), removed: arr.filter((_, i) => removeSet.has(i)), removeCount: rc };
}

// ============================================================
// CÂU 10: Kiểm tra phân phối chuẩn
// ============================================================
function checkNormalDistribution(arr) {
  const n = arr.length, mean = calcMean(arr), std = Math.sqrt(calcVariance(arr));
  const ci = (lo, hi) => arr.filter(x => x >= lo && x <= hi).length;
  const p1 = (ci(mean - std, mean + std) / n * 100).toFixed(1);
  const p2 = (ci(mean - 2 * std, mean + 2 * std) / n * 100).toFixed(1);
  const p3 = (ci(mean - 3 * std, mean + 3 * std) / n * 100).toFixed(1);
  let m3 = 0, m4 = 0;
  for (const x of arr) { m3 += (x - mean) ** 3; m4 += (x - mean) ** 4; }
  const skewness = (m3 / n / std ** 3).toFixed(4);
  const kurtosis = (m4 / n / std ** 4).toFixed(4);
  const excessKurtosis = (m4 / n / std ** 4 - 3).toFixed(4);
  const isNormal = Math.abs(p1 - 68) < 15 && Math.abs(p2 - 95) < 10 && Math.abs(p3 - 99.7) < 5
                && Math.abs(skewness) < 0.5 && Math.abs(excessKurtosis) < 1;
  return { mean: mean.toFixed(2), std: std.toFixed(2), p1, p2, p3, skewness, kurtosis, excessKurtosis, isNormal };
}

// ============================================================
// MAIN
// ============================================================
function runLab03() {
  const original = generateArray(20, 1, 100);
  const sorted   = bubbleSort(original);
  const stats    = statistics(original);
  const nd       = checkNormalDistribution(original);
  const { filtered, removed, removeCount } = removeOutliers(original);

  addSection('Câu 1: Sinh mảng ngẫu nhiên', 'Mảng gốc (20 phần tử): ' + original.join(', '));
  addSection('Câu 2: Tổng các phần tử', 'Tổng: ' + sumArray(original));

  addSection('Câu 3: Sắp xếp (Bubble Sort)',
    'Tăng dần : ' + sorted.join(', '));

  addSection('Câu 4: Tìm kiếm nhị phân',
  (() => {
    const x = sorted[4];
    const i = binSearch(sorted, x);
    return i !== -1 ? `BinSearch(${x}) → tìm thấy tại index ${i}` : `BinSearch(${x}) → không tìm thấy`;
  })());

  addSection('Câu 5: Tứ phân vị (Quartile)',
    [sorted[2], sorted[7], sorted[13], sorted[17]].map(x => findQuartile(sorted, x)).join('\n'));

  addSection('Câu 6: Shuffle (Fisher-Yates)', 'Mảng sau shuffle: ' + shuffle(sorted).join(', '));

  addSection('Câu 7: Chỉ số thống kê',
    `Min           : ${stats.min}\nMax           : ${stats.max}\nTrung bình    : ${stats.mean.toFixed(2)}\nTrung vị      : ${stats.median}\nPhương sai    : ${stats.variance.toFixed(2)}\nĐộ lệch chuẩn: ${stats.stdDev.toFixed(2)}`);

  addSection('Câu 8: Histogram (10 khoảng)',
    histogram(original).map(b => `  ${b.range.padEnd(22)} → ${b.count} phần tử`).join('\n'));

  addSection('Câu 9: Loại outliers (10%)',
    `Số bị loại     : ${removeCount}\nPhần tử bị loại: ${removed.join(', ')}\nMảng còn lại   : ${filtered.join(', ')}`);

  addSection('Câu 10: Kiểm tra phân phối chuẩn',
    `Mean / Std          : ${nd.mean} / ${nd.std}\nTrong ±1σ           : ${nd.p1}%  (lý thuyết ~68%)\nTrong ±2σ           : ${nd.p2}%  (lý thuyết ~95%)\nTrong ±3σ           : ${nd.p3}%  (lý thuyết ~99.7%)\nSkewness            : ${nd.skewness}\nKurtosis            : ${nd.kurtosis}\nExcess Kurtosis     : ${nd.excessKurtosis}\n\n -->KẾT LUẬN: ${nd.isNormal ? 'Xấp xỉ phân phối chuẩn' : 'Không xấp xỉ phân phối chuẩn'}`);
}

window.addEventListener('DOMContentLoaded', runLab03);
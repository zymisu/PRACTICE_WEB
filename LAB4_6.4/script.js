// ── State ──────────────────────────────────────────────
let danhSach = [];        // mảng lưu danh sách người
let selectedIndex = null; // chỉ số hàng đang được chọn để xoá

// ── DOM refs ───────────────────────────────────────────
const btnThem  = document.getElementById('btnThem');
const btnXoa   = document.getElementById('btnXoa');
const tableBody = document.getElementById('tableBody');
const emptyRow  = document.getElementById('emptyRow');
const countBadge = document.getElementById('countBadge');

// ── Validate ───────────────────────────────────────────
function validateForm() {
  let ok = true;
  const hoten   = document.getElementById('hoten');
  const namsinh = document.getElementById('namsinh');
  const quocgia = document.getElementById('quocgia');

  // Họ tên
  const fieldHoten = document.getElementById('field-hoten');
  if (!hoten.value.trim()) {
    fieldHoten.classList.add('invalid');
    ok = false;
  } else {
    fieldHoten.classList.remove('invalid');
  }

  // Năm sinh
  const fieldName = document.getElementById('field-namsinh');
const year = parseInt(namsinh.value);
if (!namsinh.value || isNaN(year) || year < 1900 || year > new Date().getFullYear()) {
  fieldName.classList.add('invalid');   
  ok = false;
} else {
  fieldName.classList.remove('invalid'); 
}

  // Quốc gia
  const fieldQG = document.getElementById('field-quocgia');
  if (!quocgia.value) {
    fieldQG.classList.add('invalid');
    ok = false;
  } else {
    fieldQG.classList.remove('invalid');
  }

  return ok;
}

// ── Thêm người ─────────────────────────────────────────
function themNguoi() {
  if (!validateForm()) return;

  const hoten   = document.getElementById('hoten').value.trim();
  const namsinh = document.getElementById('namsinh').value.trim();
  const quocgia = document.getElementById('quocgia').value;

  // Thu thập sở thích được tick
  const checkboxes = document.querySelectorAll('input[name="sothich"]:checked');
  const soThich = Array.from(checkboxes).map(cb => cb.value);

  const nguoi = { hoten, namsinh, quocgia, soThich };
  danhSach.push(nguoi);

  renderTable();
  resetForm();
}

// Xoá hàng đang chọn
function xoaNguoi() {
  if (selectedIndex === null) {
    resetForm();
    return;
  }
  danhSach.splice(selectedIndex, 1);
  selectedIndex = null;
  renderTable();
  resetForm();
}

// Chọn hàng từ bảng → đổ lại form
function selectRow(index) {
  selectedIndex = index;

  // Highlight hàng được chọn
  document.querySelectorAll('#tableBody tr').forEach(tr => tr.classList.remove('selected'));
  const rows = document.querySelectorAll('#tableBody tr.data-row');
  if (rows[index]) rows[index].classList.add('selected');

  // Đổ dữ liệu vào form
  const nguoi = danhSach[index];
  document.getElementById('hoten').value   = nguoi.hoten;
  document.getElementById('namsinh').value = nguoi.namsinh;
  document.getElementById('quocgia').value = nguoi.quocgia;

  // Reset checkboxes rồi tick đúng
  document.querySelectorAll('input[name="sothich"]').forEach(cb => {
    cb.checked = nguoi.soThich.includes(cb.value);
  });
}

// Render bảng
function renderTable() {
  // Xoá tất cả hàng data cũ
  document.querySelectorAll('#tableBody tr.data-row').forEach(r => r.remove());

  // Hiện / ẩn empty state
  emptyRow.style.display = danhSach.length === 0 ? '' : 'none';

  // Cập nhật badge
  countBadge.textContent = danhSach.length + ' người';

  danhSach.forEach((nguoi, i) => {
    const tr = document.createElement('tr');
    tr.classList.add('data-row');
    if (selectedIndex === i) tr.classList.add('selected');

    // Tags sở thích
    const hobbyHTML = nguoi.soThich.length > 0
      ? nguoi.soThich.map(s => `<span class="hobby-tag">${s}</span>`).join('')
      : '<span style="color:#94a3b8">—</span>';

    tr.innerHTML = `
      <td class="stt-cell">${i + 1}</td>
      <td>${escHtml(nguoi.hoten)}</td>
      <td>${escHtml(nguoi.namsinh)}</td>
      <td>${hobbyHTML}</td>
      <td>${escHtml(nguoi.quocgia)}</td>
      <td><button class="btn-select" onclick="selectRow(${i})">Chọn</button></td>
    `;

    tableBody.appendChild(tr);
  });
}

// ── Reset form ─────────────────────────────────────────
function resetForm() {
  document.getElementById('hoten').value   = '';
  document.getElementById('namsinh').value = '';
  document.getElementById('quocgia').value = '';
  document.querySelectorAll('input[name="sothich"]').forEach(cb => cb.checked = false);

  // Xoá class invalid
  ['field-hoten', 'field-namsinh', 'field-quocgia'].forEach(id => {
    document.getElementById(id).classList.remove('invalid');
  });

  // Bỏ highlight
  document.querySelectorAll('#tableBody tr').forEach(tr => tr.classList.remove('selected'));
  selectedIndex = null;
}

// ── Escape HTML ────────────────────────────────────────
function escHtml(str) {
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;');
}

// ── Event listeners ────────────────────────────────────
btnThem.addEventListener('click', themNguoi);
btnXoa.addEventListener('click', xoaNguoi);

// Xoá lỗi khi người dùng bắt đầu nhập
document.getElementById('hoten').addEventListener('input', () =>
  document.getElementById('field-hoten').classList.remove('invalid'));
document.getElementById('namsinh').addEventListener('input', () =>
  document.getElementById('field-namsinh').classList.remove('invalid'));
document.getElementById('quocgia').addEventListener('change', () =>
  document.getElementById('field-quocgia').classList.remove('invalid'));

// Khởi tạo
renderTable();
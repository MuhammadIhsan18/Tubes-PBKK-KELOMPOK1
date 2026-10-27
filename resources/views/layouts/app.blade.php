<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventaris Alat Lab Komputer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --navy:#1b2f45; --teal:#0f7c8c; --teal-dark:#0b6270; --bg:#f3f6fa; --line:#e3e9f0; }
        body { font-family:'Inter',system-ui,sans-serif; background:var(--bg); color:#1f2d3d; }
        .brand { display:flex; gap:10px; align-items:center; color:#fff; text-decoration:none; }
        .brand-icon { width:38px; height:38px; border-radius:9px; background:var(--teal); display:grid; place-items:center; font-size:1.2rem; }
        .brand small { display:block; color:#94a3b8; font-size:.7rem; }
        .topbar { background:var(--navy); padding:12px 32px; }
        .main { max-width:1280px; margin:0 auto; padding:26px 32px 40px; }
        .card-lab { background:#fff; border:1px solid var(--line); border-radius:12px; }
        .btn-teal { background:var(--teal); border-color:var(--teal); color:#fff; font-weight:500; }
        .btn-teal:hover { background:var(--teal-dark); border-color:var(--teal-dark); color:#fff; }
        .crumb { font-size:.8rem; color:#64748b; margin-bottom:10px; }
        .crumb a { color:#64748b; text-decoration:none; }
        .page-title { font-weight:700; font-size:1.6rem; margin:0; }
        .page-sub { color:#64748b; font-size:.9rem; }
        .stat { padding:16px 18px; display:flex; justify-content:space-between; align-items:center; height:100%; }
        .stat .num { font-size:1.9rem; font-weight:700; line-height:1; }
        .stat .lbl { font-size:.72rem; letter-spacing:.04em; text-transform:uppercase; color:#64748b; margin-bottom:6px; }
        .stat-icon { width:40px; height:40px; border-radius:10px; display:grid; place-items:center; font-size:1.2rem; }
        .table-lab thead th { background:#f8fafc; font-size:.72rem; letter-spacing:.04em; text-transform:uppercase; color:#64748b; border-bottom:1px solid var(--line); padding:12px 16px; }
        .table-lab td { padding:14px 16px; vertical-align:middle; border-color:var(--line); }
        .tag { background:#e0f2fe; color:#075985; font-size:.75rem; font-weight:600; padding:3px 9px; border-radius:6px; }
        .pill { font-size:.75rem; font-weight:600; padding:4px 10px; border-radius:20px; display:inline-flex; gap:6px; align-items:center; }
        .pill::before { content:''; width:7px; height:7px; border-radius:50%; background:currentColor; }
        .pill-baik { background:#dcfce7; color:#15803d; }
        .pill-ringan { background:#fef3c7; color:#b45309; }
        .pill-berat { background:#fee2e2; color:#b91c1c; }
        .icon-btn { width:32px; height:32px; border-radius:8px; border:1px solid var(--line); background:#fff; display:inline-grid; place-items:center; color:#475569; text-decoration:none; }
        .icon-btn:hover { background:#f1f5f9; }
        .icon-btn.danger:hover { background:#fee2e2; color:#b91c1c; border-color:#fecaca; }
        .section-head { display:flex; gap:12px; align-items:center; padding:14px 20px; border-bottom:1px solid var(--line); }
        .section-no { width:28px; height:28px; border-radius:50%; background:#e6f4f6; color:var(--teal); font-weight:700; display:grid; place-items:center; font-size:.85rem; }
        .form-label { font-weight:600; font-size:.85rem; }
        .form-control:focus, .form-select:focus { border-color:var(--teal); box-shadow:0 0 0 .2rem rgba(15,124,140,.15); }
        .kondisi-option { position:relative; display:block; height:100%; cursor:pointer; margin:0; }
        .kondisi-option input { position:absolute; opacity:0; }
        .kondisi-card { border:1.5px solid var(--line); border-radius:10px; padding:14px; height:100%; display:flex; gap:12px; align-items:center; background:#fff; }
        .kondisi-card i { font-size:1.4rem; }
        .kondisi-option input:checked + .kondisi-card { border-color:var(--teal); background:#effafb; box-shadow:0 0 0 3px rgba(15,124,140,.12); }
        .kondisi-option input:focus-visible + .kondisi-card { outline:2px solid var(--teal); }
        @media (max-width: 767px) {
            .topbar { padding:10px 16px; }
            .main { padding:20px 16px; }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <a href="{{ route('alatlab.index') }}" class="brand">
            <span class="brand-icon"><i class="bi bi-pc-display"></i></span>
            <span><strong>Inventaris Alat Lab</strong><small>Laboratorium Komputer</small></span>
        </a>
    </header>

    <main class="main">
        @if (session('success'))
            <div class="alert alert-success d-flex align-items-center gap-2 alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <div><strong>Berhasil!</strong> {{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
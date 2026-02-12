@extends('admin.layout')

@section('title', 'Historique')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="header">
    <label for="menu-toggle" class="menu-btn">☰</label>
    <h1>histoirque du trafic</h1>

    <a href="#" class="btn btn-danger">
        <i class="bi bi-plus"></i> verification
    </a>

    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Rechercher un projet...">
        <div id="searchResults"></div>
    </div>
</div>

{{-- MOBILE --}}
<div class="history-mobile">
    @foreach($histories as $history)
        <div class="history-card">
            <div class="history-row">
                <span class="badge {{ $history->action === 'approved' ? 'approved' : 'rejected' }}">
                    {{ ucfirst($history->action) }}
                </span>
                <small>{{ $history->created_at->format('d/m/Y H:i') }}</small>
            </div>

            <div class="history-email">{{ $history->email }}</div>
            <div class="history-type">{{ ucfirst($history->type) }}</div>

            <button class="btn btn-approve btn-sm view-message"
                data-message="{{ e($history->message) }}">
                Voir message
            </button>
        </div>
    @endforeach
</div>

{{-- DESKTOP --}}
<div class="history-desktop table-wrapper">
    <table>
        <thead>
            <tr>
                <th>Action</th>
                <th>Email</th>
                <th>Type</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($histories as $history)
                <tr>
                    <td>
                        <span class="badge {{ $history->action === 'approved' ? 'approved' : 'rejected' }}">
                            {{ ucfirst($history->action) }}
                        </span>
                    </td>
                    <td>{{ $history->email }}</td>
                    <td>{{ $history->type }}</td>
                    <td>{{ Str::limit($history->message, 40) }}</td>
                    <td>{{ $history->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div style="margin-top:20px;">
    {{ $histories->links() }}
</div>



{{-- MODAL --}}
<div id="messageModal" style="
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.5);
    z-index:10000;
    align-items:center;
    justify-content:center;
">
    <div style="
        background:#fff;
        padding:20px;
        border-radius:14px;
        width:90%;
        max-width:500px;
    ">
        <h3 style="color:var(--red);margin-top:0;">Message</h3>
        <p id="modalMessage" style="white-space:pre-wrap;"></p>
        <button class="btn btn-reject" id="closeModal">Fermer</button>
    </div>
</div>

<script>
document.querySelectorAll('.view-message').forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('modalMessage').textContent = btn.dataset.message;
        document.getElementById('messageModal').style.display = 'flex';
    });
});

document.getElementById('closeModal').addEventListener('click', () => {
    document.getElementById('messageModal').style.display = 'none';
});
</script>









<style>   /* HISTORIQUE MOBILE FIRST */
.history-mobile {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.history-card {
    background: #fff;
    padding: 15px;
    border-radius: 14px;
    box-shadow: 0 6px 15px rgba(0,0,0,.08);
}

.history-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.history-email {
    font-weight: 600;
    margin: 8px 0 4px;
    word-break: break-all;
}

.history-type {
    color: var(--muted);
    font-size: 14px;
    margin-bottom: 10px;
}

/* DESKTOP */
.history-desktop {
    display: none;
}

@media (min-width: 768px) {
    .history-mobile {
        display: none;
    }
    .history-desktop {
        display: block;
    }
}


.header {
    display: flex;
    flex-wrap: wrap;      /* les éléments passent à la ligne si écran petit */
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    background: linear-gradient(135deg, #efecec, #dadada, #e2e2e2);
    color: #fff;
    border-radius: 10px;
    margin-bottom: 20px;
}

.header h1 {
    font-size: 25px;
    margin: 8px 0;
    flex: 1;
    text-align: center;
    color: rgb(181, 46, 46);  /* centrer le titre */
}

.header .menu-btn {
    font-size: 24px;
    cursor: pointer;
    background: rgb(181, 46, 46);
    border: none;
    color: #e3dfdf;

}
</style>
@endsection

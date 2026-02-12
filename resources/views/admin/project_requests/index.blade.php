@extends('admin.layout')

@section('title', 'Gestion des demandes')

@section('content')
<div class="header">
    <label for="menu-toggle" class="menu-btn">☰</label>
    <h1>Demandes</h1>

    <div class="search-bar">
        <input type="text" placeholder="Rechercher...">
    </div>
</div>

<div class="cards">
    <div class="card"><i class="bi bi-people-fill"></i><h3>Total demandes</h3><p>{{ $totalRequests }}</p></div>
    <div class="card"><i class="bi bi-file-earmark-person"></i><h3>Demandes CV</h3><p>{{ $cvRequests }}</p></div>
    <div class="card"><i class="bi bi-folder2-open"></i><h3>Demandes Projets</h3><p>{{ $projectRequests }}</p></div>
    <div class="card"><i class="bi bi-clock-history"></i><h3>En attente</h3><p>{{ $pendingRequests }}</p></div>
</div>

<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Type</th>
                <th>Projet / Message</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requestItems as $item)
            <tr data-id="{{ $item->id }}">
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ ucfirst($item->type) }}</td>
                <td>{{ $item->message }}</td>
                <td>
                    <span class="badge {{ $item->status ?? 'pending' }}">
                        {{ $item->status ?? 'pending' }}
                    </span>
                </td>
                <td>
                    <button class="btn btn-approve">Autoriser</button>
                    <button class="btn btn-reject">Refuser</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div style="margin-top:15px;">
    {{ $requestItems->links() }} <!-- Pagination -->
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Approve / Reject buttons
    document.querySelectorAll('.btn-approve, .btn-reject').forEach(btn => {
        btn.addEventListener('click', function(){
            const row = btn.closest('tr');
            if(!row || !row.dataset.id) return;

            const id = row.dataset.id;
            // Détermine le status selon le bouton
            const status = btn.classList.contains('btn-approve') ? 'approved' : 'rejected';

            // URL PATCH pour correspondre à la route définie
            fetch(`/dashboard/demandes/${id}/${status}`, {
                method: 'PATCH', // PATCH car la route l'attend
                headers: {
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    const badge = row.querySelector('.badge');
                    badge.textContent = data.status;
                    badge.className = 'badge ' + data.status;
                }
            })
            .catch(err => console.error(err));
        });
    });
});
</script>
@endsection

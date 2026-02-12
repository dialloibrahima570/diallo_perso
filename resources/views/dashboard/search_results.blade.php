<h2 style="margin:20px 0;">Résultats pour : "{{ $query }}"</h2>

@if($results->isEmpty())
    <p>Aucun résultat trouvé.</p>
@else
    <table class="table" style="width:100%; border-collapse:collapse;">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Type</th>
                <th>Motif</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->motif }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

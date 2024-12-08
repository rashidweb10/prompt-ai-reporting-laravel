<h2>Generated SQL Query:</h2>
<p>{{ $sqlQuery }}</p>

<h2>Results:</h2>
@if (!empty($results))
    <table border="1">
        <thead>
            <tr>
                @foreach (array_keys((array)$results[0]) as $column)
                    <th>{{ $column }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $row)
                <tr>
                    @foreach ((array)$row as $value)
                        <td>{{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No results found.</p>
@endif

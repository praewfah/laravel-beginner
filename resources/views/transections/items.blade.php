<table class="table table-striped task-table">
    <thead>
        <th>Date</th>
        <th>Category</th>
        <th>Description</th>
        <th>Type</th>
        <th>Amount</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($transections as $transection)
            <tr>
                <td class="table-text">{{ date('d F Y', strtotime($transection->transection_date)) }}</td>
                <td class="table-text">{{ $transection->budget_category }}</td>
                <td class="table-text">{{ $transection->description }}</td>
                <td class="table-text">{{ $transection->budget_type }}</td>
                <td class="table-text">{{ $transection->actual }}</td>

                <!-- Task Delete Button -->
                <td class="text-right">
                    <form action="{{url('transection/' . $transection->id)}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button type="submit" id="delete-task-{{ $transection->id }}" class="btn btn-danger">
                            <i class="fa fa-btn fa-trash"></i>Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

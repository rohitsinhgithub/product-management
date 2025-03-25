<table class="table table-bordered table-centered mb-0">
    <tbody>
        <tr>
            <th>Vehicle:</th>
            <td>{{ $formObj->vehicle_title }}</td>
        </tr>
        <tr>
            <th>Name:</th>
            <td>{{ $formObj->first_name . ' ' . $formObj->last_name }}</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>{{ $formObj->email }}</td>
        </tr>
        <tr>
            <th>Phone:</th>
            <td>{{ $formObj->tel_num }}</td>
        </tr>
        <tr>
            <th>Would like to visit:</th>
            <td>{{ $formObj->visit ? date('d M [ h:i A ]' , strtotime($formObj->visit)) : '-' }}</td>
        </tr>
        <tr>
            <th>comments:</th>
            <td>{{ $formObj->msg }}</td>
        </tr>
        <tr>
            <th>Created At:</th>
            <td>{{ $formObj->created_at ? date('d M [ h:i A ]' , strtotime($formObj->created_at)) : '-' }}</td>
        </tr>
        <tr>
            <th>Updated At:</th>
            <td>{{ $formObj->updated_at ? date('d M [ h:i A ]' , strtotime($formObj->updated_at)) : '-' }}</td>
        </tr>
    </tbody>
</table>
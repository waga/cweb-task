<h1>Users</h1>

<table class="table">
<thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Email</th>
    <th scope="col">First name</th>
    <th scope="col">Surname</th>
    <th scope="col">Address</th>
    <th scope="col">Country</th>
    <th scope="col">Post code</th>
    <th scope="col">Phone</th>
    <th scope="col"></th>
</tr>
</thead>
<tbody>
    <?php foreach ($users as $user) { ?>
        <tr>
            <th scope="row"><?php echo $user['id']; ?></th>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['first_name']; ?></td>
            <td><?php echo $user['last_name']; ?></td>
            <td><?php echo $user['address']; ?></td>
            <td><?php echo $user['country']; ?></td>
            <td><?php echo $user['post_code']; ?></td>
            <td><?php echo $user['phone']; ?></td>
        </tr>
    <?php } ?>
</tbody>
</table>

<h2>Manage Orders</h2>
<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Total Amount</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $order['id'] ?></td>
                <td><?= $order['user_id'] ?></td>
                <td>$<?= $order['total_amount'] ?></td>
                <td><?= $order['status'] ?></td>
                <td>
                    <a href="?action=view_order&id=<?= $order['id'] ?>">View</a>
                    <a href="?action=update_order&id=<?= $order['id'] ?>">Update</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
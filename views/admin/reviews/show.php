<?php $this->view('partitions.admin.header', ['roles' => $roles]); ?>

<div class="action">
    <h2>Review</h2>
    <button class="btn btn-create"><i class="fas fa-plus-circle"></i> Create Review</button>
</div>
<div class="content">
    <h1>List Reviews</h1>
    <table>
        <thead>
            <tr>
                <th>Customer</th>
                <th>Book</th>
                <th>Headline</th>
                <th>Rating</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="content-body">
            <?php
            foreach ($reviews as $review) {
            ?>
                <tr>
                    <td><?php echo $review['customer_id'] ?></td>
                    <td><?php echo $review['book_id'] ?></td>
                    <td><?php echo $review['headline'] ?></td>
                    <td><?php echo $review['rating'] ?> <i class="far fa-star"></i></td>
                    <td>
                        <a href="" class="btn-delete-review" review-id="<?php echo $review['review_id'] ?>"><i class="fas fa-trash-alt"></i></a>
                        <a href="" class="btn-update-review" review-id="<?php echo $review['review_id'] ?>"><i class="fas fa-edit"></i></a>
                        <a href="" class="btn-change-status" review-id="<?php echo $review['review_id'] ?>"><i class="far fa-check-circle"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php $this->view('partitions.admin.footer') ?>
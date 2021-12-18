</div>
</div>
</div>
</main>
<footer>

</footer>
<script src="../public/admin/js/Validator.js"></script>
<script src="../public/admin/js/user.js"></script>
<script src="../public/admin/js/category.js"></script>
<script src="../public/admin/js/order.js"></script>
<script src="../public/admin/js/voucher.js"></script>
<!-- text editor -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/jquery.tinymce.min.js" referrerpolicy="origin"></script>
<script>
    if ($('#description')) {
        $('#description').tinymce({
            height: 170,
            with: 300,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help'
        });
    }
</script> -->
<!-- ck editor -->
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    let name = document.querySelector('.action h2');
    if (name && name.innerText.toLowerCase() == 'book')
        CKEDITOR.replace('description');
</script>
<script src="../public/admin/js/book.js"></script>
</body>

</html>
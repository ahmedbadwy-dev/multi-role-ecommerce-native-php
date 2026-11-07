<div class="card">
    <div class="card-header">
        <h3 class="text-center">Product Images</h3>
    </div>
    <div class="card-body">
        <form action="../../controller/admin/images/AddImagesContrller.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $_GET['productId'] ?>">
            <div class="form-group">
                <label for="Product Images">Product Images</label>
                <input type="file" name="images[]" id="Product Images" class="form-control" placeholder="Enter Files Images" multiple>
            </div>


            <div class="form-group">

                <input type="submit" class="form-control btn btn-success" value="Add Images">
            </div>



        </form>

    </div>
</div>
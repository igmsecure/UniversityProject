const $deleteEmporiumBtns = document.querySelectorAll('.js-delete-emporium'),
    $deletePointBtns = document.querySelectorAll('.js-delete-point'),
    $deleteProductBtns = document.querySelectorAll('.js-delete-product'),
    $deleteCategoryBtns = document.querySelectorAll('.js-delete-category'),
    $aviableProductCheckboxes = document.querySelectorAll('.js-aviable-checkbox');


const sendDeleteEmporiumData = (id) => {
    $.ajax({
        url: './ajax/delete_emporium.php',
        type: 'POST',
        cache: false,
        data: {
            'id': id,
        },
        dataType: 'html',
        success: function(data) {
            location.reload();
        }
    });
};

const sendDeletePointData = (id) => {
    $.ajax({
        url: './ajax/delete_point.php',
        type: 'POST',
        cache: false,
        data: {
            'id': id,
        },
        dataType: 'html',
        success: function(data) {
            location.reload();
        }
    });
};

const sendDeleteProductData = (id) => {
    $.ajax({
        url: './ajax/delete_product.php',
        type: 'POST',
        cache: false,
        data: {
            'id': id,
        },
        dataType: 'html',
        success: function(data) {
            location.reload();
        }
    });
};

const sendDeleteCategoryData = (id) => {
    $.ajax({
        url: './ajax/delete_category.php',
        type: 'POST',
        cache: false,
        data: {
            'id': id,
        },
        dataType: 'html',
        success: function(data) {
            location.reload();
        }
    });
};

const sendChangeProductData = (id, status) => {
    $.ajax({
        url: './ajax/change_product_status.php',
        type: 'POST',
        cache: false,
        data: {
            'id': id,
            'status': status
        },
        dataType: 'html',
        success: function(data) {}
    });
};

$deleteEmporiumBtns.forEach(deleteEmporiumBtn => {
    deleteEmporiumBtn.addEventListener('click', () => {
        const id = deleteEmporiumBtn.parentElement.parentElement.dataset.id;

        sendDeleteEmporiumData(id);
    });
});

$deletePointBtns.forEach(deletePointBtn => {
    deletePointBtn.addEventListener('click', () => {
        const id = deletePointBtn.parentElement.parentElement.dataset.id;

        sendDeletePointData(id);
    });
});

$deleteProductBtns.forEach(deleteProductBtn => {
    deleteProductBtn.addEventListener('click', () => {
        const id = deleteProductBtn.parentElement.parentElement.dataset.id;

        sendDeleteProductData(id);
    });
});

$deleteCategoryBtns.forEach(deleteCategoryBtn => {
    deleteCategoryBtn.addEventListener('click', () => {
        const id = deleteCategoryBtn.parentElement.parentElement.dataset.id;

        sendDeleteCategoryData(id);
    });
});

$aviableProductCheckboxes.forEach(aviableProductCheckbox => {
    aviableProductCheckbox.addEventListener('change', () => {
        const id = aviableProductCheckbox.parentElement.parentElement.parentElement.parentElement.dataset.id;

        sendChangeProductData(id, +aviableProductCheckbox.checked);
    });
});
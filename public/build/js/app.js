

document.getElementById("produits_Price").addEventListener("change", function (event) {
    if (document.getElementById('produits_Price').value === "")
        document.getElementById('produits_Price').value = '0.00';

});

$('.custom-file-input').on('change', function (event) {

    let inputFile = event.currentTarget;
    $(inputFile).parent().find('.custom-file-label').html(inputFile.files[0].name);
    document.getElementById('produits_Image').value = inputFile.files[0].name;

});

function myFunction() {
    var x = document.getElementById("inputPassword");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

$('.custom-file-input').on('change', function (event) {

    let inputFile = event.currentTarget;
    $(inputFile).parent().find('.custom-file-label').html(inputFile.files[0].name);
    document.getElementById('produits_Image').value = inputFile.files[0].name;

});


//////////create_produits
$('#create_produits').on("click", function () {
    var Name = document.getElementById("produits_Name").value;
    var des = document.getElementById("produits_Description").value;
    var price = document.getElementById("produits_Price").value;
    var image = document.getElementById("produits_Image").value;
    if (Name !== "" && des !== "" && price !== "" && image !== "")
        Swal.fire('Produits created successfully', 'OK', 'success')

});
///////edit produits
$("#edit_produits").submit(function () {
    var Name = document.getElementById("produits_Name").value;
    var des = document.getElementById("produits_Description").value;
    var price = document.getElementById("produits_Price").value;
    var image = document.getElementById("produits_Image").value;
    if (Name !== "" && des !== "" && price !== "" && image !== "")
        Swal.fire('Produit Update successfully', 'OK', 'success')

});

/////edit_cat

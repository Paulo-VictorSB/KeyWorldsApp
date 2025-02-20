$(document).ready(function () {
    $(".menu-toggle").click(()=> {
        $(".menu-overlay").addClass("open");
    });

    $(".close-menu").click(()=> {
        $(".menu-overlay").removeClass("open");
    });

    $(".menu-content a").click(()=> {
        $(".menu-overlay").removeClass("open");
    });

    $("#textoProtegido").on("copy paste cut contextmenu selectstart", function(e) {
        e.preventDefault(); // Impede a ação padrão
        alert("Copiar este conteúdo não é permitido!");
    });

});
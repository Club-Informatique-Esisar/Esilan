$(document).ready(function() {
    // SORTING TABLE
    const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

    const comparer = (idx, asc) => (a, b) => ((v1, v2) => 
        v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
        )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));
    
    document.querySelectorAll('th.sortable').forEach(th => th.addEventListener('click', (() => {
        const table = th.closest('thead').nextElementSibling;
        Array.from(table.querySelectorAll('tr:nth-child(n+1)'))
            .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
            .forEach(tr => table.appendChild(tr) );
    })));

    // gallery
    $(".img-fullable").click(function() {
        $("#gallery").css("display","block");
        $("#img-gallery").attr("src",$(this).attr("src"));
    })

    $("#gallery").click(() => {
        $("#gallery").css("display","none");
    })



    // RICH EDITOR
    CKEDITOR.replace( 'inputDesc' );

    // TODO: Why not vanilla js form img-fullable

});





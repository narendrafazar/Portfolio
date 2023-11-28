$(function () {
  $(document).scroll(function () {
    var $nav = $(".navbar-fixed-top");
    // mengecek seberapa panjang heightnya pas lagi nyecroll dari atas ke bawah
    $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
  });
});

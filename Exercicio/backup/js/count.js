// Cache do elemento para evitar constantes ciclos de procura pelo mesmo
var $input = $("#idteste");

// Colocar a 1 ao início
$input.val(1);

// Aumenta ou diminui o valor sendo 0 o mais baixo possível
$(".altera").click(function() {
  if ($(this).hasClass('acrescimo'))
    $input.val(parseInt($input.val()) + 1);
  else if ($input.val() >= 1)
    $input.val(parseInt($input.val()) - 1);
});

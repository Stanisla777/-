$.fn.ketchup.messages = {
  'помидор': 'Нужен помидор!',
  'либо': 'Должно быть либо $arg1 либо $arg2.'
}

$.fn.ketchup.validation('помидор', function(element, value) {
  if(value == 'помидор') return true;
  else return false;
});

$.fn.ketchup.validation('либо', function(element, value, word1, word2) {
  var valueL = value.toLowerCase();
  
  if(valueL == word1.toLowerCase() || valueL == word2.toLowerCase()) return true;
  else return false;
});
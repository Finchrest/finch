
const options = {
  range: { min:0, max:10000000, step:100000},
  initialSelectedValues: { from:0, to:10000000 },
  grid: { minTicksStep: 1, marksStep: 10000 },
  showInputs:true,
  onChange:IState,
  };
$('.js-example-class').alRangeSlider(options);



function IState(){
$('.js-al-range-slider__tooltip').each(function( index ) {
if($(this).text() != 0){
  $(this).text(numFormatter($(this).text()));
}
i++;
});
}

var i=0;
$('.js-al-range-slider__grid-mark').each(function( index ) {
if(i != 0){
  $(this).text(numFormatter($(this).text()));
}
i++;
});

function numFormatter(num) {
     if (num >= 1000000000) {
        return (num / 1000000000).toFixed(1).replace(/\.0$/, '') + 'G';
     }
     if (num >= 1000000) {
        return (num / 1000000).toFixed(1).replace(/\.0$/, '') + 'M';
     }
     if (num >= 1000) {
        return (num / 1000).toFixed(1).replace(/\.0$/, '') + 'K';
     }
     return num;
}
angular.module('app', [], function($interpolateProvider){
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
})
.controller('orderController', ['$scope', '$http', function($,$http){
    $._ = _;
    $.items = 1;
}])
.controller('mainController', function($scope){

});

$('*[data-href]').click(function(){
   window.location = $(this).attr('data-href');
});

$('.tracking-table tr').not('.item-info').click(function(){
    $(this).next().toggleClass('opened');
})
var paperPrintOptions = document.getElementsByName("paperPrint");
var startPage = document.getElementById("startPage");

for (let option of paperPrintOptions){
    option.addEventListener('click',function(){
        TogglePageRange(option.value);
    });
}
function TogglePageRange(value){
    if (value == "chooseRange"){
        startPage.disabled = false;
    }else{
        startPage.disabled = true;
    }
}

$(document).ready(function(){
    $(".searchbook").on("click",function(){
        console.log("Hello i ma")
    })
  
    let reviewContent =   $("#review-content")
    if(localStorage.getItem("content")){
        reviewContent.val(localStorage.getItem("content"))
    }
    else{
        localStorage.setItem("content","")
    }
    let value = ""
    reviewContent.keyup((e)=>{
        value = reviewContent.val()
        console.log(value);
        localStorage.setItem("content",value)
    })
})

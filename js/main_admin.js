// Get Current Date for Admin Dashboard
let currentDateLable = document.querySelectorAll('.currentDate');
let today = new Date();
let day = (today.getDate() < 10 ? "0" : "") +today.getDate();
let month = (today.getMonth() < 10 ? "0" : "")+today.getMonth();

let curDate = day + ' / ' + month + ' / ' + today.getFullYear();
currentDateLable.forEach((item)=>{
    item.innerHTML = curDate;
})



//Get Current Time for Admin Dashboard
let currentTimeLable = document.querySelectorAll('.currentTime');
setInterval(() => {
    currentTimeLable.forEach((item)=>{
        let time =new Date();
        let currentTime = time.toLocaleTimeString();
        item.innerHTML = currentTime;
    })
},1000);
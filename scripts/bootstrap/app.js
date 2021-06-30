const time  = 1;
    let count = time*60;
    
    const countdownEle = document.getElementById("countdown");
    
    
    setInterval(timer, 1000);
    
    function timer()
    {
        const minutes = Math.floor(count / 60);
        let seconds = count % 60;
        if(minutes < 0 && seconds < 0)
        {
            countdownEle.innerHTML = "Your time is up";
            location.href="location:welcome.php?q=result&eid=$eid";
        }
        else{
            countdownEle.innerHTML = minutes + " : " + seconds;
            count--;
        }
         
    }
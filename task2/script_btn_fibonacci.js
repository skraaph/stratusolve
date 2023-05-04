function getFibonacci(event) {
    event.preventDefault();
    var max = document.getElementById("max").value;
    var xmlHttpRequest = new XMLHttpRequest();
    xmlHttpRequest.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            var data = JSON.parse(this.responseText);
            document.getElementById("result").innerHTML = data.join(" ");
        }
    };
    xmlHttpRequest.open("POST", "fibonacci.php", true);
    xmlHttpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlHttpRequest.send("max=" + max);
}
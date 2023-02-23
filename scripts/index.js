//footer last modified date

const dateModified = new Date();
const shortendate = new Intl.DateTimeFormat("en-US", { dateStyle: "full" }).format(
	dateModified);
document.getElementById("date").innerText = (shortendate)


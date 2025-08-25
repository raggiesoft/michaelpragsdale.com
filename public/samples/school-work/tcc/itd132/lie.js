const lieStatement = document.getElementById("statement1");
const lieExplainer = document.getElementById("lie-explainer");
const lieCode = document.getElementById("lie-code");

lieCode.style.display = "none";

function showLie()
{
    lieStatement.classList.add("active");

    lieExplainer.innerHTML = "<section class=\"card\"><section class=\"card-body\">"
    + "<ul>"
    + "<li>What is now Ocean View Beach Park was once an amusement park complete with roller coaster</li>"
    + "<li>I am an only child. I&rsquo;m writing down ideas for a book where the main characters are a twin brother and sister, as well as an older sister (thus 'two sisters')</li>"
    + "<li>Ronald Reagan was President in 1985 when <em>Back to the Future</em> came out</li>"
    + "</ul>";
}

function showLieCode()
{
    lieCode.style.display = "block";
}

function hideLieCode()
{
    lieCode.style.display = "none";
}
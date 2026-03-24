function analyzeText()
{
    var text = document.getElementById("textInput").value;

    var cleanText = text.trim();

    if(cleanText === "")
    {
        alert("Please enter some text");
        return;
    }

    // Character count
    var charCount = cleanText.length;

    // Word count (handles multiple spaces)
    var words = cleanText.split(/\s+/);
    var wordCount = words.length;

    // Reverse text
    var reversedText = cleanText.split("").reverse().join("");

    // Display result
    document.getElementById("result").innerHTML =
        "Total Characters: " + charCount + "<br>" +
        "Total Words: " + wordCount + "<br>" +
        "Reversed Text: " + reversedText;
}
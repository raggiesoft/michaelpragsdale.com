
const root = document.querySelector(':root');

const btnViewAPACover = document.getElementById("button-view-apa-cover");
const modalAPACover = new bootstrap.Modal("#modal-ai-apa-cover-data");

const btnViewAbstract = document.getElementById("button-view-abstract");
const modalAbstract = new bootstrap.Modal("#modal-ai-abstract-data");

const btnViewResearchQuestion = document.getElementById("button-view-research-question");
const modalResearchQuestion = new bootstrap.Modal("#modal-ai-research-question-data");

const btnViewAPAReferences = document.getElementById("button-view-apa-references");
const modalAPAReferences = new bootstrap.Modal("#modal-apa-references-data");

const btnViewPDFFile = document.getElementById("button-view-paper-pdf");
const modalPDFPage = new bootstrap.Modal("#modal-pdf-document-data");

const aiPDFPageTitle = document.getElementById("ai-pdf-title");
const aiPDFDocument = document.getElementById("ai-pdf-document");
const aiPDFSpinner = document.getElementById("pdf-spinner");

const btnDownloadPDF = document.getElementById("button-download-pdf");

let pdfLoaded = false;

let googleViewer =
{
    googleURL:"https://drive.google.com/viewerng/viewer",
    embed: true,
    documentURL: ""
};
const fileDocumentPDF = "https://drive.google.com/viewerng/viewer?embedded=true&url=https://michaelpragsdale.com/samples/school-work/odu/ids300w/files/ai-paper/document/mrags002_ai-research-paper.pdf";

const btnModalCloseFooter = "<button type=\"button\" class=\"btn btn-danger\" data-bs-dismiss=\"modal\"><i class=\"fa-duotone fa-rectangle-xmark me-2\" aria-hidden=\"true\"></i>Close</button>";
const btnModalCloseHeader = "<button type=\"button\" class=\"btn btn-danger\" data-bs-dismiss=\"modal\" aria-label=\"Close\"><i class=\"fa-duotone fa-rectangle-xmark\" aria-hidden=\"true\"></i></button>";



function enableButton(buttonIDName, requestEnable)
{
    let buttonName = document.getElementById(buttonIDName);
    if (requestEnable)
    {
        buttonName.removeAttribute("disabled");
        buttonName.classList.remove("Disabled");
    }
    else
    {
        buttonName.setAttribute("disabled", "disabled");
        buttonName.classList.add("disabled");
    }
}

// Objects that contain our Document data
const aiDocument =
{
    abstract: "<p>This paper examines the main challenges and implications of artificial intelligence (AI) from a legal and ethical perspective, focusing on the questions of copyright, accuracy, authorship, ownership, liability, explainability, and robustness. The paper provides an overview of the definitions and applications of AI, such as generative AI, and the potential benefits and risks of AI for human society. The paper also discusses some of the workable solutions and directions for future research and regulation of AI systems, such as consulting legal counsel, adopting different models and theories of liability, and ensuring the transparency and accountability of AI systems. The paper concludes by highlighting the need to balance the rights and interests of the AI creators, users, and agents, as well as the human authors, inventors, and collaborators, and the third-party beneficiaries, licensees, and infringers, and to develop and implement AI systems that are beneficial and responsible for humanity.</p><p>This paper also discusses the use of interdisciplinary studies and the use of AI to create webpages. It explores the potential benefits and challenges of using AI in web development, including the ethical and practical questions surrounding the legality and accuracy of the generated content. The paper also delves into the limitations of AI and the questions of copyright ownership, authorship, and liability of AI-generated works.</p>",
    author:
    {
        firstName: "Michael",
        lastName: "Ragsdale"
    },
    dueDate: "July 20th, 2024",
    figures: [
        "Sister tutoring her brother on the Ten Steps of the Interdisciplinary Process",
        "Aubrie, David, and Shannon after a round of backyard basketball. Who owns the rights to this image?",
        "David is discharged from the hospital and Aubrie and Shannon need to get him home",
        "The three siblings are at the Downtown Transportation Center. This #45 is supposed to be the same vehicle as the #2 in the previous image",
        "The #3 is their ride back to their house, and is supposed to be a different vehicle but at the same Downtown Transportation Center as the previous image",
        "Left to Right Shannon, Aubrie, and David on their first day of college. Note how there are fall/winter clothes on typically what would be (in Virginia) a sizzling summer day."
    ],
    keywords: ["AI", "Authorship", "Copyright", "Ethical Implication", "Explainability", "Graphics Design", "Liability", "Limitations", "Ownership", "Robustness", "Webpages"],
    question: "What are the major challenges of integrating Artificial Intelligence in Web Design?",
    references:
    [
        "Abbott, R. (2016, September 28). <em>I Think, Therefore I Invent: Creative Computers and the Future of Patent Law</em>. Retrieved from Boston College Law Review: <a target=\"_blank\" href=\"https://bclawreview.bc.edu/articles/566\">https://bclawreview.bc.edu/articles/566<i class=\"fa-duotone fa-external-link-alt ms-1\" aria-hidden=\"true\"></i></a>",
        "Alejandro Barredo Arrieta, N. D.-R.-L. (2020). <em>Explainable Artificial Intelligence (XAI): Concepts, taxonomies, opportunities and challenges toward responsible AI</em>. Information Fusion, 82-115. doi:<a target=\"_blank\" href=\"https://doi.org/10.1016/j.inffus.2019.12.012\">https://doi.org/10.1016/j.inffus.2019.12.012<i class=\"fa-duotone fa-external-link-alt ms-1\" aria-hidden=\"true\"></i></a>",
        "Coleman, M. (2022, December). <em>10 Step Interdisciplinary Research Process</em>. Retrieved July 16, 2024, from Old Dominion University: <a target=\"_blank\" href=\"https://sites.wp.odu.edu/wp-content/uploads/sites/30242/2022/12/Mackenzie-Coleman-Workshop-1.pdf\">https://sites.wp.odu.edu/wp-content/uploads/sites/30242/2022/12/Mackenzie-Coleman-Workshop-1.pdf<i class=\"fa-duotone fa-external-link-alt ms-1\" aria-hidden=\"true\"></i></a>",
        "Floridi, L., Cowls, J., Beltrametti, M., Chatila, R., Chazerand, P., Dignum, V.,  Vayena, E. &hellip; (2018, November 26). <em>AI4People—An Ethical Framework for a Good AI Society: Opportunities, Risks, Principles, and Recommendations</em>. Minds &amp; Machines, 28, 689-707. doi:<a target=\"_blank\" href=\"https://doi.org/10.1007/s11023-018-9482-5\">https://doi.org/10.1007/s11023-018-9482-5<i class=\"fa-duotone fa-external-link-alt ms-1\" aria-hidden=\"true\"></i></a>",
        "Gil Appel, J. N. (2023, April 7). <em>Generative AI Has an Intellectual Property Problem</em>. Retrieved from Harvard Business Review: <a target=\"_blank\" href=\"https://hbr.org/2023/04/generative-ai-has-an-intellectual-property-problem\">https://hbr.org/2023/04/generative-ai-has-an-intellectual-property-problem<i class=\"fa-duotone fa-external-link-alt ms-1\" aria-hidden=\"true\"></i></a>",
        "Haapio, H., &amp; Passera, S. (2013, May 15). <em>Visual Law: What Lawyers Need to Learn from Information Designers</em>. Retrieved July 15, 2024, from VOXPOPULII (Cornell Legal Information Institute): <a target=\"_blank\" href=\"https://blog.law.cornell.edu/voxpop/2013/05/15/visual-law-what-lawyers-need-to-learn-from-information-designers\">https://blog.law.cornell.edu/voxpop/2013/05/15/visual-law-what-lawyers-need-to-learn-from-information-designers/<i class=\"fa-duotone fa-external-link-alt ms-1\" aria-hidden=\"true\"></i></a>",
        "Hendrycks, D., &amp; Dietterich, T. (2019). <em>Benchmarking Neural Network Robustness to Common Corruptions and Perturbations</em>. Cornell University. March. doi:<a target=\"_blank\" href=\"https://doi.org/10.48550/arXiv.1903.12261\">https://doi.org/10.48550/arXiv.1903.12261<i class=\"fa-duotone fa-external-link-alt ms-1\" aria-hidden=\"true\"></i></a>",
        "Kelly, R. (2019, October 1). <em>10 tips for next generation interdisciplinary research</em>. Retrieved July 16, 2024, from Integration and Implementation Insights: <a target=\"_blank\" href=\"https://i2insights.org/2019/10/01/10-tips-for-interdisciplinary-research/\">https://i2insights.org/2019/10/01/10-tips-for-interdisciplinary-research/<i class=\"fa-duotone fa-external-link-alt ms-1\" aria-hidden=\"true\"></i></a>",
        "Microsoft. (2023, October 25). <em>Designer for Web Image Generator and Brand Kit Terms Preview</em>. Retrieved July 15, 2024, from Microsoft Designer: <a target=\"_blank\" href=\">https://designer.microsoft.com/termsOfUse.pdf\">https://designer.microsoft.com/termsOfUse.pdf<i class=\"fa-duotone fa-external-link-alt ms-1\" aria-hidden=\"true\"></i></a>",
        "Miller, T. (2019). <em>Explanation in artificial intelligence: Insights from the social science</em>. Artificial Intelligence, 1-38. doi:<a target=\"_blank\" href=\"https://doi.org/10.1016/j.artint.2018.07.007\">https://doi.org/10.1016/j.artint.2018.07.007<i class=\"fa-duotone fa-external-link-alt ms-1\" aria-hidden=\"true\"></i></a>",
        "Ragsdale, M. (2024, May 27). <em>The Ten Steps of the Interdisciplinarity Research Process</em>. Retrieved July 16, 2024, from Michael Ragsdale's Portfolio: <a target=\"_blank\" href=\"https://michaelpragsdale.com/samples/school-work/odu/ids300w/files/writing-workshop-01/\">https://michaelpragsdale.com/samples/school-work/odu/ids300w/files/writing-workshop-01/<i class=\"fa-duotone fa-external-link-alt ms-1\" aria-hidden=\"true\"></i></a>",
        "Repko, A. F., &amp; Szostak, R. (2021). <em>Interdisciplinary Research Process and Theory (4th Edition)</em>. Los Angeles: Sage Publishing."
    ],
    title: "Legal and Limitation Questions for Using AI to Create Web Pages",
    universityInformation:
    {
        course: "IDS 300W",
        instructor: "Dr. LaFever",
        name: "Old Dominion University"
    }
};


function backgroundImageSlideShow()
{
    
    const totalImages = 4;
    let currentImage = 1; // 1 based

    setInterval(() => {
        if (currentImage > totalImages)
        {
            currentImage = 1;
        }
        root.style.setProperty("--ai-hero-image", "url('/samples/school-work/odu/ids300w/files/assets/images/hero/hero-" + currentImage + "-min.png')");
        currentImage++;
    }, 5000);
}

// Generate Sections
function generateAbstract()
{
    let aiAbstractPage = document.getElementById("ai-abstract-data");
    let aiKeywordsParagraph = document.createElement("p");
    aiKeywordsParagraph.classList.add("abstract-keywords");
    aiAbstractPage.innerHTML = aiDocument.abstract;

    aiKeywordsParagraph.innerHTML = "Keywords: ";
    for (let i = 0; i < aiDocument.keywords.length; i++)
    {
        aiKeywordsParagraph.innerHTML += aiDocument.keywords[i];    
        if (i < (aiDocument.keywords.length - 1))
        {
            aiKeywordsParagraph.innerHTML += ", ";
        }
    }

    aiAbstractPage.appendChild(aiKeywordsParagraph);
}
function generateAPACoverPage()
{
    let aiAPACoverPage = document.getElementById("ai-apa-cover-page-data");
    aiAPACoverPage.innerHTML = "<p>" + aiDocument.author.firstName + " " + aiDocument.author.lastName + "</p>";
    aiAPACoverPage.innerHTML += "<p>" + aiDocument.universityInformation.name + "</p>";
    aiAPACoverPage.innerHTML += "<p>" + aiDocument.universityInformation.course + "</p>";
    aiAPACoverPage.innerHTML += "<p>" + aiDocument.universityInformation.instructor + "</p>";
    aiAPACoverPage.innerHTML += "<p>" + aiDocument.dueDate + "</p>";
}
function generateQuestion()
{
    let aiQuestion = document.getElementById("ai-research-question-data");
    let questionBlockquote = document.createElement("blockquote");
    questionBlockquote.classList.add("blockquote");
    questionBlockquote.innerHTML = aiDocument.question;

    let instructorApprovalMark = document.createElement("p");
    instructorApprovalMark.classList.add("text-center");
    instructorApprovalMark.innerHTML = "This question was approved by " + aiDocument.universityInformation.instructor;

    aiQuestion.appendChild(questionBlockquote);
    aiQuestion.appendChild(instructorApprovalMark);
}
function generateReferences()
{
    let aiReferencesPage = document.getElementById("ai-apa-references-page");
    for (let i = 0; i < aiDocument.references.length; i++)
    {
        aiReferencesPage.innerHTML += "<p>" + aiDocument.references[i] + "</p>";
    }
}
function generatePDFViewer()
{
    aiPDFPageTitle.innerHTML = "<i class=\"fa-duotone fa-exclamation-triangle me-2\" aria-hidden=\"true\"></i>Document Load Failure";
    console.log("Page Title: " + aiDocument.title);

    let ifPDF = document.createElement("iframe");
    console.log("Generated iFrame");
    ifPDF.id = "ai-pdf-document-iframe";
    ifPDF.classList.add("w-100", "d-none");
    ifPDF.src = fileDocumentPDF;
    console.log("iFrame Source Found");
    
    aiPDFDocument.style.overflowY = "hidden";
    console.log("Append iFrame to Modal");
    
    // Let's assume we don't have access to the Google Drive Viewer
    aiPDFDocument.innerHTML = "<p class=\"h3 text-dark\" id=\"pdf-render-error\">Unfortunately, the document viewer could not be loaded. Please select from Word or PDF using the Download Document button below.</p>";
    aiPDFDocument.appendChild(ifPDF);

    // But we DO have access to the Google Drive Viewer
    document.getElementById("ai-pdf-document-iframe").addEventListener('load', function(event)
    {
        ifPDF.classList.remove("d-none");
        aiPDFSpinner.classList.add("d-none");
        aiPDFPageTitle.innerHTML = "<i class=\"fa-duotone fa-file-lines me-2\" aria-hidden=\"true\"></i>Rough Draft";
        
        document.getElementById("pdf-render-error").remove();
        
        pdfLoaded = true;
        btnViewPDFFile.classList.remove("disabled");
        btnViewPDFFile.innerHTML = "<i class=\"fa-duotone fa-file-lines me-2\" aria-hidden=\"true\"></i>Read Rough Draft";
        console.log("iFrame fully loaded");
    });

    window.addEventListener('resize', function(event){
        ifPDF.height = aiPDFDocument.clientHeight - 35;
        console.log("iFrame: Got New Offset Height: " + aiPDFDocument.clientHeight);
    });

    let modalPDFPageElement = document.getElementById("modal-pdf-document-data");
    modalPDFPageElement.addEventListener('shown.bs.modal', event => {
        ifPDF.height = aiPDFDocument.clientHeight - 35;
        console.log("iFrame Should Be Seen Now");
    });

    setTimeout(function(){
        if (!pdfLoaded)
        {
            btnViewPDFFile.innerHTML = "<i class=\"fa-duotone fa-file-lines me-2\" aria-hidden=\"true\"></i>Read Rough Draft";
            console.log("Can't Connect to Google Drive!");
            btnViewPDFFile.classList.remove("disabled");
        }
    }, 5000);
}

function generateFiguresModal()
{
    modalFigures.title = ""
}

function showFigureImage(figureNumber)
{
    modalFigures.title.innerHTML = "Figure " + (figureNumber + 1);
    modalFigures.body.innerHTML
}

function generateTitleData()
{
    let aiTitleText = document.getElementById("document-title");
    aiTitleText.innerHTML = aiDocument.title;

    let aiSubtitleText = document.getElementById("document-subtitle");
    aiSubtitleText.innerHTML = "A Research Paper by " + aiDocument.author.firstName + " " + aiDocument.author.lastName;
}

// View Sections
function viewAPACover()
{
    modalAPACover.show();
}
function viewAbstract()
{
    modalAbstract.show();
}
function viewResearchQuestion()
{
    modalResearchQuestion.show();
}
function viewAPAReferences()
{
    modalAPAReferences.show();
}
function viewPDFFile()
{
    if (pdfLoaded)
    {
        modalPDFPage.show();
    }
    else
    {
        aiPDFSpinner.classList.add("d-none");
        document.getElementById("modal-pdf-options").classList.remove("modal-fullscreen");
        document.getElementById("modal-pdf-options").classList.add("modal-xl");
        modalPDFPage.show();
    }
}



generateAPACoverPage();
generateAbstract();
generateQuestion();
generateReferences();
generateTitleData();
generatePDFViewer();

backgroundImageSlideShow();
btnViewAPACover.addEventListener("click", viewAPACover);
btnViewAbstract.addEventListener("click", viewAbstract);
btnViewResearchQuestion.addEventListener("click", viewResearchQuestion);
btnViewAPAReferences.addEventListener("click", viewAPAReferences);
btnViewPDFFile.addEventListener("click", viewPDFFile);


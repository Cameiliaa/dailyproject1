<!DOCTYPE html>
<html>
<head>
    <title>PDF Viewer</title>
</head>
<body>

<h2>PDF Viewer</h2>

<!-- container -->
<div id="pdf-container"></div>

<!-- PDF.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>

<script>
pdfjsLib.GlobalWorkerOptions.workerSrc =
  "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js";

let url = "/pdf-file/{{ $file_id }}";

let pdfDoc = null;
let pageNum = {{ $lastPage }};

// LOAD PDF
pdfjsLib.getDocument(url).promise.then(function(pdf) {
    pdfDoc = pdf;
    renderAllPages();

    // scroll ke halaman terakhir
    setTimeout(() => {
        let target = document.querySelector(`[data-page="${pageNum}"]`);
        if (target) {
            target.scrollIntoView();
        }
    }, 1000);
});

// RENDER SEMUA HALAMAN
function renderAllPages() {
    let container = document.getElementById("pdf-container");

    for (let i = 1; i <= pdfDoc.numPages; i++) {
        pdfDoc.getPage(i).then(function(page) {

            let viewport = page.getViewport({scale: 1.5});

            let canvas = document.createElement('canvas');
            let ctx = canvas.getContext('2d');

            canvas.height = viewport.height;
            canvas.width = viewport.width;

            canvas.setAttribute("data-page", i);

            container.appendChild(canvas);

            page.render({
                canvasContext: ctx,
                viewport: viewport
            });
        });
    }
}

// DETEKSI SCROLL
window.addEventListener("scroll", function () {
    let canvases = document.querySelectorAll("canvas");

    canvases.forEach((canvas) => {
        let rect = canvas.getBoundingClientRect();

        if (rect.top >= 0 && rect.top <= window.innerHeight / 2) {
            pageNum = canvas.getAttribute("data-page");
        }
    });
});

// SIMPAN PROGRESS
window.addEventListener("beforeunload", function () {
    fetch("/save-progress", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            file_id: "{{ $file_id }}",
            last_page: pageNum
        })
    });
});
</script>

</body>
</html>

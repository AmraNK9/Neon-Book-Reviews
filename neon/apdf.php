<!DOCTYPE html>
<html>
<head>
  <title>Open PDF in the Same Page</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <button id="btnA">Open A-PDF</button>
  <button id="btnB">Open B-PDF</button>
  <div id="pdfContainer"></div>

  <script>
    $(document).ready(function() {
      $("#btnA").click(function() {
        openPDF("pdf/ei_maung.pdf");
      });

      $("#btnB").click(function() {
        openPDF("pdf/sample.pdf");
      });
    });

    function openPDF(filePath) {
      var pdfContainer = $("#pdfContainer");
      
      pdfContainer.html('<iframe src="' + filePath + '" width="100%" height="600px" ></iframe>');
    }
  </script>
</body>
</html>

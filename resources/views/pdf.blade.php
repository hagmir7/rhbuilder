<iframe src="{{ $pdfUrl }}" id="pdf-frame" style="width:100%;height:100vh;"></iframe>

<script>
window.onload = () => {
    const iframe = document.getElementById('pdf-frame');
    iframe.onload = () => {
        iframe.contentWindow.focus();
        iframe.contentWindow.print();
    };
};
</script>

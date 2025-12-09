<div id="brixo-footer-container"></div>
<script src="/js/footer.js"></script>

<script>
</script>
window.brixoUser = <?= json_encode(session()->get('user') ?? null) ?>;
</script>

<script src="/js/navbar.js"></script>

<style>
    .hover-text-white:hover {
        color: #fff !important;
        transition: color 0.3s ease;
    }
</style>
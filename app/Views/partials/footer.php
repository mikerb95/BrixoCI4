<div id="brixo-footer-container"></div>
<script src="/js/footer.js"></script>

<script>
    window.brixoUser = <?= json_encode(session()->get('user') ?? null) ?>;
    window.csrfTokenName = '<?= csrf_token() ?>';
    window.csrfHash = '<?= csrf_hash() ?>';
</script>

<?= view('partials/modals') ?>
<script src="/js/navbar.js?v=<?= time() ?>"></script>

<style>
    .hover-text-white:hover {
        color: #fff !important;
        transition: color 0.3s ease;
    }
</style>
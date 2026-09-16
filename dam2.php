<form id="hiddenForm" action="dam_data2.php" method="POST">
    <input type="hidden" name="partIDCode" value="12345"> <!-- مقدار شناسه یکتا -->
    <input type="hidden" name="sal" value="1403"> <!-- مقدار سال -->
</form>
<script>
    // ارسال خودکار فرم پس از بارگذاری صفحه
    document.getElementById("hiddenForm").submit();
</script>
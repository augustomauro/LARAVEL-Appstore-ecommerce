<script>
    // Function to execute PHP code through javascript
    // It is necessary to declare the function in PHP and share it in the view / s
    function closeAlert() {
        console.log(@json($functionClass->clearAlert()));
        // alert(@json($functionClass->clearAlert()));
        return @json($functionClass->clearAlert());
    }
</script>
<!-- Sort -->
<script type="text/javascript">
    if ($('.tab-content')) {
        var ascending = false;
        var decrease = true;
        // Convert $ to string ''
        var convertToNumber = function (value) {
            return parseFloat(value.replace('$', ''));
        }
        // Sort the price is ascending
        $('.tab-content').on('click', '.priceAscending', function () {
            var sorted = $('.results-row').sort(function (a, b) {
                return (ascending ==
                    (convertToNumber($(a).find('.price').html()) <
                        convertToNumber($(b).find('.price').html()))) ? 1 : -1;
            });
            $('.results').html(sorted);
        });
        // Sort the price is decrease
        $('.tab-content').on('click', '.decreaseAscending', function () {
            var sorted = $('.results-row').sort(function (a, b) {
                return (decrease ==
                    (convertToNumber($(a).find('.price').html()) <
                        convertToNumber($(b).find('.price').html()))) ? 1 : -1;
            });
            $('.results').html(sorted);
        });
    }
</script>
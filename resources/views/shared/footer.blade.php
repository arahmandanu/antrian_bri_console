<footer class="bg-black for-footer mt-auto" style="position: absolute; width: 100%; overflow: hidden; bottom: 0">

    @if ($footer_text->count() == 0)
        <p class="text-white walking-text invisible" style="white-space: nowrap; float: left; ">-</p>
    @else
        <p id="animate_footer" class="text-white walking-text" style="white-space: nowrap; float: left; "></p>
    @endif
</footer>

<script>
    const element = document.getElementById('animate_footer');
    const array = {!! json_encode($footer_text) !!};
    $(document).ready(function() {
        if (element) {
            animate();
        }
    });

    function animate(index = 0) {
        let elementWidth = element.offsetWidth;
        let parentWidth = element.parentElement.offsetWidth;
        let flag = 0;

        if (array.length == 0) return;
        if (array[index] === undefined) return animate(array, 0);

        $('p#animate_footer').text(array[index].text);
        setInterval(() => {
            element.style.marginLeft = ++flag + "px";

            if (parentWidth == flag) {
                flag = 0;
                index = index + 1;
                if (array[index] === undefined) {
                    index = 0;
                }
                $('p#animate_footer').text(array[index].text);
            }
        }, 10);
    }
</script>

$(".readmore__bottom").on('click', function() {
    $(this).parent().toggleClass("showContent");
})
$(document).ready(
    function () {

        //Chọn các phần tử button và gán sự kiện click cho nó
        $(".thumbnail").click(function () {

            //Chọn phần tử có id là test và thi hành ẩn các phần tử đó
            $(".thumbnail").hide();

        });
    }
);
const imgs = document.querySelectorAll('.img-select a');
const imgBtns = [...imgs];
let imgId = 1;

imgBtns.forEach((imgItem) => {
    imgItem.addEventListener('click', (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
    });
});

function slideImage(){
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
}

window.addEventListener('resize', slideImage);
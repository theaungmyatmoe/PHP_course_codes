</div>
</div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"
integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U"
crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9"
crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js"></script>
<script>
let like = document.querySelector('#like');
like.addEventListener('click', likeIt);
function likeIt() {
let userId = like.getAttribute('userId');
let articleId = like.getAttribute('articleId');
let showCount = document.querySelector('#showCount');
if (userId == '') {
location.href = "login.php"
} else {
axios.get(`like.php?userId=${userId}&articleId=${articleId}`).then((res)=> {
if (res.data == 'liked') {
toastr.warning('You have already liked!')
}
if (Number.isInteger(res.data)) {
showCount.innerHTML = res.data;
toastr.success('You Liked Successfilly!')
}
})
}
}

// Comment

let cmt_list = document.querySelector("#cmt_list");
let form = document.querySelector('#form');

form.addEventListener('submit', function(e) {
e.preventDefault();
let cmt = document.querySelector("#cmt");
let data = new FormData();
let article_id = form.getAttribute('article_id');
data.append('comment', cmt.value)
data.append('article_id', article_id)
axios.post('comment.php', data)
.then((res)=> {
cmt_list.innerHTML = res.data;
console.log(res.data);
})
});

function searchIt(e) {
let search = document.querySelector('#search').value;
location.href = `index.php?search=${search}`
}


</script>


</body>
</html>
<?php
ob_end_flush();
?>
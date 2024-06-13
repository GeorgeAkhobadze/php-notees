    document.addEventListener('DOMContentLoaded', function() {
        var buttons = document.querySelectorAll('.get-post-id-btn');

        buttons.forEach(function(button) {

            if (button.getAttribute('data-liked') === 'true') {
                button.classList.add('liked');
            }



            button.addEventListener('click', function() {
                var likeCountElement = this.nextElementSibling;
                var likeCount = parseInt(this.getAttribute('data-like-count'))
                var noteId = this.getAttribute('data-note-id');
                var isLiked = this.classList.contains('liked');

                const isLikedData = button.getAttribute('data-liked') === 'true';
                const newLikeCount = isLiked ? (isLikedData ? likeCount - 1 : likeCount) : (isLikedData ? likeCount : likeCount + 1);
                likeCountElement.innerHTML = `${newLikeCount} likes`;

                axios.post('/notes/like', { noteId: noteId, liked: !isLiked })
                    .then((res) => {
                        console.log(res);
                        this.classList.toggle('liked');
                    })
                    .catch(error => console.error(error));
            });
        });
    });

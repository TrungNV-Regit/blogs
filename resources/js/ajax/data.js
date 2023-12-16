const dataElement = $('#data');

const data = {
    blog: {
        id: dataElement.attr('blog-id')
    },
    route: {
        like: dataElement.attr('like-route'),
        commentIndex: dataElement.attr('comment-index-route'),
        commentCreate: dataElement.attr('comment-create-route'),
        commentUpdate: dataElement.attr('comment-update-route'),
        commentDestroy: dataElement.attr('comment-destroy-route'),
        login: dataElement.attr('login-route'),
    }
};

export default data;

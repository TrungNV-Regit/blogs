import "../config.js"
import "../../bootstrap.js";
import services from "./services.js";
import data from "../data.js";

let formUpdateCommentCurrent = null;
let formUpdateReplyCurrent = null;

$(document).ready(function () {

    $.ajax({
        url: data.route.commentIndex,
        type: 'GET',
        success: function (response) {
            $("#comments").html(response);
        },
        error: function (xhr) {
            throw new Error(xhr);
        }
    });

    $('#comments').on('click', '.useAjax', function (event) {
        event.preventDefault();
        let replyElement = $(this).closest('div.replies');
        $.ajax({
            url: $(this).attr('href'),
            type: 'GET',
            success: function (response) {
                if (replyElement.length) {
                    replyElement.html(response);
                    replyElement.find('ul.pagination').addClass('mb-2');
                    $('html, body').animate({
                        scrollTop: replyElement.offset().top
                    }, 0);
                } else {
                    $('html, body').animate({
                        scrollTop: $("#commentAjax").offset().top
                    }, 0);
                    $("#comments").html(response);
                }
            },
            error: function (xhr) {
                throw new Error(xhr);
            }
        });
    });

    $('#store').submit(function (event) {
        event.preventDefault();
        let content = $('#comment').val().replace(/</g, "&lt;").replace(/>/g, "&gt;");
        $.ajax({
            url: data.route.commentCreate,
            type: 'POST',
            data: {
                blog_id: data.blog.id,
                content: content,
            },
            success: function (response) {
                let data = JSON.parse(response);
                let newElement = services.createElement(data.comment, data.user);
                let commentElement = $("<div></div>").addClass("single-comment").html(newElement);
                $("#comments").prepend(commentElement);
                services.handleIncrementComment();
                $('#comment').val("");
            },
            error: function (xhr) {
                if (xhr.status == 401 || xhr.status == 403) {
                    window.location.href = data.route.login;
                }
            }
        });
    });

    $('#comments').on('submit', '.updateComment', function (event) {
        event.preventDefault();
        let form = $(this);
        let oldComment = $(this).siblings('p');
        let id = parseInt(oldComment.attr('data-id'));
        let content = $(this).find('input[name="comment"]').val().replace(/</g, "&lt;").replace(/>/g, "&gt;");
        $.ajax({
            url: data.route.commentUpdate,
            type: 'PUT',
            data: {
                id: id,
                content: content,
            },
            success: function (response) {
                let comment = JSON.parse(response)
                oldComment.find('span:first').text(comment.content);
                oldComment.show();
                form.addClass('d-none');
                formUpdateCommentCurrent = null;
                formUpdateReplyCurrent = null;
            },
            error: function (xhr) {
                if (xhr.status == 401) {
                    window.location.href = data.route.login;
                }
            }
        });
    });

    $('#comments').on('click', '.destroy-comment', function () {
        let id = parseInt($(this).parent().attr('data-id'));
        let commentElement = $(this).closest(".single-comment");
        $.ajax({
            url: data.route.commentDestroy,
            type: 'DELETE',
            data: {
                id: id,
            },
            success: function (response) {
                let data = JSON.parse(response);
                if (data.parent_id) {
                    let totalReplyElement = commentElement.parent().siblings('span.totalReply');
                    services.handleDisplayTotalReply(totalReplyElement, false);
                }
                services.handleDecreaseComment(data);
                commentElement.remove();
            },
            error: function (xhr) {
                throw new Error(xhr);
            }
        });
    });

    $('#comments').on('click', '.update-comment', function () {
        let parrentElement = $(this).closest('p');
        let form = parrentElement.siblings('form.updateComment');
        handleUpdateComment();
        formUpdateCommentCurrent = form;
        parrentElement.hide();
        form.removeClass('d-none');
        let inputElement = form.find('input[name="comment"]');
        let inputValue = inputElement.val();
        inputElement.focus().get(0).setSelectionRange(inputValue.length, inputValue.length);
    });

    $('#comments').on('click', '.revert-update', function () {
        let parrentElement = $(this).closest('.comment-detail');
        parrentElement.find('p').show();
        parrentElement.find('form').addClass('d-none');
    });


    $('#comments').on('click', '.totalReply', function () {
        let divElement = $(this).siblings('div.replies');
        let endpoint = $(this).attr('endpoint');
        if (divElement.text().trim()) {
            divElement.html('');
        } else {
            $.ajax({
                url: endpoint,
                type: 'GET',
                success: function (response) {
                    divElement.html(response);
                    divElement.find('ul.pagination').addClass('mb-2');
                },
                error: function (xhr) {
                    throw new Error(xhr);
                }
            });
        }
    });

    $('#comments').on('submit', '.storeTheReply', function (event) {
        event.preventDefault();
        let form = $(this);
        let content = $(this).find('input[name=comment]').val().replace(/</g, "&lt;").replace(/>/g, "&gt;");
        let endpoint = $(this).attr('endpoint');
        let parentId = $(this).attr('comment-parent');
        let divElement = form.siblings('div:first');
        let totalReplyElement = form.siblings('span.totalReply');
        $.ajax({
            url: endpoint,
            type: 'POST',
            data: {
                blog_id: data.blog.id,
                content: content,
                parentId: parentId,
            },
            success: function (response) {
                form.addClass('d-none');
                form.find('input[name=comment]').val('');
                services.handleCreateReplySuccess(totalReplyElement.attr('endpoint'), divElement);
                services.handleDisplayTotalReply(totalReplyElement, true);
                totalReplyElement.removeClass('d-none');
                services.handleIncrementComment();
            },
            error: function (xhr) {
                if (xhr.status == 401 || xhr.status == 403) {
                    window.location.href = data.route.login;
                }
            }
        });
    });

    $('#comments').on('click', '.reply-comment', function () {
        let formElement = $(this).parent().siblings('form:first');
        handleUpdateComment();
        formUpdateReplyCurrent = formElement;
        formElement.removeClass('d-none');
        formElement.find('input').focus();
    });

    function handleUpdateComment() {
        if (formUpdateReplyCurrent) {
            formUpdateReplyCurrent.addClass('d-none');
            formUpdateReplyCurrent.siblings('p').show();
        }
        if (formUpdateCommentCurrent) {
            formUpdateCommentCurrent.addClass('d-none');
            formUpdateCommentCurrent.siblings('p').show();
        }
    }
});

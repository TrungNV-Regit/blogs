import "../config.js"
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

    function createElement(comment, author) {
        let result =
            `<div class="author">
                <img class="author-picture" src="${author.link_avatar}"
                    alt="${author.username}">
                <span>${author.username}</span>
            </div>
            <div class="comment-detail">
                <p data-id="${comment.id}">
                    <span>${comment.content}</span>
                    <span class="destroy-comment">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-trash" viewBox="0 0 16 16">
                        <path
                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                        <path
                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                    </svg>
                    </span>
                    <span class="update-comment">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.4998 5.49994L18.3282 8.32837M3 20.9997L3.04745 20.6675C3.21536 19.4922 3.29932 18.9045 3.49029 18.3558C3.65975 17.8689 3.89124 17.4059 4.17906 16.9783C4.50341 16.4963 4.92319 16.0765 5.76274 15.237L17.4107 3.58896C18.1918 2.80791 19.4581 2.80791 20.2392 3.58896C21.0202 4.37001 21.0202 5.63634 20.2392 6.41739L8.37744 18.2791C7.61579 19.0408 7.23497 19.4216 6.8012 19.7244C6.41618 19.9932 6.00093 20.2159 5.56398 20.3879C5.07171 20.5817 4.54375 20.6882 3.48793 20.9012L3 20.9997Z"
                                stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <span class="reply-comment">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16">
                            <path fill="currentColor"
                                d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822c.984.624 1.99 1.76 2.595 3.876c-1.02-.983-2.185-1.516-3.205-1.799a8.74 8.74 0 0 0-1.921-.306a7.404 7.404 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254a.503.503 0 0 0-.042-.028a.147.147 0 0 1 0-.252a.499.499 0 0 0 .042-.028zM7.8 10.386c.068 0 .143.003.223.006c.434.02 1.034.086 1.7.271c1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66c-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96z" />
                        </svg>
                    </span>
                </p>
                <form endpoint="${data.route.commentCreate}" comment-parent=${comment.id}
                    class="d-none storeTheReply" method="POST">
                    <input name="comment" required />
                    <div>
                        <button type="submit" class="d-none" id="{{ 'replyComment' . $comment->id }}"></button>
                        <label for="{{ 'replyComment' . $comment->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-send" viewBox="0 0 16 16">
                                <path
                                    d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                            </svg>
                        </label>
                        <label class="revert-update">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                            </svg>
                        </label>
                    </div>
                </form>

                <form method="post" action="${data.route.commentUpdate}" class="updateComment d-none">
                    <input name="comment" data-id=${comment.id} value="${comment.content}" required />
                    <div>
                        <button type="submit" class="d-none" id="updateComment${comment.id}"></button>
                            <label for="updateComment${comment.id}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                    class="bi bi-send" viewBox="0 0 16 16">
                                    <path
                                        d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                                </svg>
                            </label>
                        <label class="revert-update">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                            </svg>
                        </label>
                    </div>
                </form>
                <span class="color-time">${comment.time_elapsed} &nbsp;&nbsp; </span>

                <span class="color-time cursor-pointer totalReply d-none"
                    endpoint="${data.route.replyIndex}?parentId=${comment.id}">
                        0 Reply
                </span>

                <div class="replies mt-4">
                </div>
            </div>`
        return result;
    }

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
                let newElement = createElement(data.comment, data.user);
                let commentElement = $("<div></div>").addClass("single-comment").html(newElement);
                $("#comments").prepend(commentElement);
                handleIncrementComment();
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
        let id = $(this).parent().attr('data-id');
        let comment = $(this).closest(".single-comment");
        $.ajax({
            url: data.route.commentDestroy,
            type: 'DELETE',
            data: {
                id: id,
            },
            success: function (response) {
                let data = JSON.parse(response);
                if (data.parent_id) {
                    let totalReplyElement = comment.parent().siblings('span.totalReply');
                    handleDisplayTotalReply(totalReplyElement, false)
                }
                comment.remove();
                let newTotalCommentlement = $('<span>').attr('id', 'totalComment');
                newTotalCommentlement.text(parseInt($('#totalComment').text()) - 1);
                $('#totalComment').slideUp(function () {
                    $(this).replaceWith(newTotalCommentlement);
                    newTotalCommentlement.hide().slideDown();
                });
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
                handleCreateReplySuccess(totalReplyElement.attr('endpoint'), divElement);
                handleDisplayTotalReply(totalReplyElement, true);
                totalReplyElement.removeClass('d-none');
                handleIncrementComment();
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

    function handleIncrementComment() {
        let newTotalCommentlement = $('<span>').attr('id', 'totalComment');
        newTotalCommentlement.text(parseInt($('#totalComment').text()) + 1);
        $('#totalComment').slideUp(function () {
            $(this).replaceWith(newTotalCommentlement);
            newTotalCommentlement.hide().slideDown();
        });
    }

    function handleDisplayTotalReply(totalReplyElement, incrementReply) {
        let totalReply = parseInt(totalReplyElement.text().match(/\d+/)[0]);
        let updateTotalReplyElement;
        if (incrementReply) {
            updateTotalReplyElement = totalReplyElement.text().replace(/\d+/, ++totalReply);
        } else {
            updateTotalReplyElement = totalReplyElement.text().replace(/\d+/, --totalReply);
        }
        totalReply ? totalReplyElement.text(updateTotalReplyElement) : totalReplyElement.addClass('d-none')
    }

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

    function handleCreateReplySuccess(endpoint, divElement) {
        $.ajax({
            url: endpoint,
            type: 'GET',
            success: function (response) {
                divElement.html(response);
            },
            error: function (xhr) {
                throw new Error(xhr);
            }
        });
    }
});

import "../../bootstrap.js";
import services from "./services.js";
import data from "../data.js";

$(document).ready(function () {

    Echo.channel(`create-comment.${data.blog.id}`)
        .listen('CommentEvent', (data) => {
            let comment = data.comment;
            let parentId = comment.parent_id;
            if (parentId) {
                let commentParentElement = $('p[data-id="' + parentId + '"]');
                let replyElement = commentParentElement.siblings('div.replies');
                let totalReplyElement = commentParentElement.siblings('span.totalReply');
                if (replyElement.text().trim()) {
                    let endpoint = totalReplyElement.attr('endpoint');
                    services.handleCreateReplySuccess(endpoint, replyElement)
                }
                services.handleDisplayTotalReply(totalReplyElement, true)
            } else {
                let newElement = services.createElement(comment, data.author, false);
                let commentElement = $("<div></div>").addClass("single-comment").html(newElement);
                $("#comments").prepend(commentElement);
            }
            services.handleIncrementComment();
        });

    Echo.channel(`update-comment.${data.blog.id}`)
        .listen('CommentEvent', (data) => {
            let commentElement = $('p[data-id="' + data.comment.id + '"]');
            commentElement.find('span:first').text(data.comment.content);
        });

    Echo.channel(`destroy-comment.${data.blog.id}`)
        .listen('CommentEvent', (data) => {
            let commentElement = $('p[data-id="' + data.comment.id + '"]');
            if (data.comment.parent_id) {
                let commentParentElement = $('p[data-id="' + data.comment.parent_id + '"]');
                let totalReplyElement = commentParentElement.siblings('span.totalReply');
                services.handleDisplayTotalReply(totalReplyElement, false);
            }
            services.handleDecreaseComment(data.comment);
            commentElement.closest('div.single-comment').remove();
        });

    Echo.channel(`like.${data.blog.id}`)
        .listen('LikeEvent', (data) => {
            services.handleLikeEvent(data.liked);
        });

});

<template>
    <aside id="course-list-item-grid" class="col-sm-12 col-md-6 col-lg-3 p-3">
        <div class="card">
            <div class="card-content">
                <div class="col-xs-4 col-sm-12 image-column">
                    <a :href="'/courses/' + courseSlug + '/' + courseId"
                       target="_blank"
                       data-ga-action="click">
                        <div class="card-img-top">
                            <img data-appear-top-offset="300"
                                 :src="courseImg"
                                 :alt="courseTitle">
                            <div class="watch-options">
                                <div role="button" class="watch-course ga" data-ga-action="click"
                                     data-ga-label="card-watch" data-ga-value="475456"
                                     data-preview-text="پیش نمایش">
                                    <i class="icon lyndacon play-circle"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xs-8 col-sm-12 card-meta-data">
                    <a :href="'/courses/' + courseSlug + '/' + courseId"
                       target="_blank"
                       data-ga-action="click" data-ga-label="card-bottom" data-ga-value="475456">
                        <div class="title-author-info">
                            <h3>{{courseTitle}}</h3>
                            <cite class="meta-author">{{courseAuthor}}</cite>
                        </div>
                    </a>
                    <div class="meta">
                        <span class="">{{courseDurationHours}} ساعت و {{courseDurationMinutes}} دقیقه</span>
                        <span class="meta-divider">بازدید <strong>{{courseViews}}</strong></span>
                    </div>
                </div>

            </div>

        </div>
    </aside>
</template>
<script>
    export default {
        data() {
            return {
                courseBookmarkCheckSrc: '/image/unchecked.png',
                courseViewsIcon: '/image/view.png',
                courseTimeIcon: '/image/time.png',
                courseDateIcon: '/image/date-icon.png',
                courseSkillBeginnerIcon: '/image/skill-level/1.svg',
                courseSkillIntermediateIcon: '/image/skill-level/2.svg',
                courseSkillAdvancedIcon: '/image/skill-level/3.svg',
            }
        },
        props: {
            courseId: null,
            courseSlug: null,
            courseImg: null,
            courseTitle: null,
            courseAuthor: null,
            courseDurationHours: null,
            courseDurationMinutes: null,
            courseViews: null,
            // courseDescription: null,
            // courseReleasedDate: null,
            // courseCreatedDate: null,
            // courseSkillLevel: null,
        },
        methods: {},
        mounted() {

        }
    }
</script>
<style>
    #course-list-item-grid .list-item-img-text a {
        text-decoration: none;
    }

    #course-list-item-grid .meta-divider::before {
        content: "";
        padding-left: 3px;
        padding-right: 6px;
    }

    @media (min-width: 768px) {
        #course-list-item-grid .card .card-meta-data .title-author-info {
            height: 70px;
        }

        #course-list-item-grid .card .card-meta-data {
            padding: 8px 15px 10px;
            display: block;
            float: left;
        }

        #course-list-item-grid .card .image-column {
            display: block;
            float: left;
        }

        /*#course-list-item-grid .col-sm-12 {*/
        /*    width: 100%;*/
        /*}*/
        #course-list-item-grid .thumbnail {
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        #course-list-item-grid .thumbnail .watch-options {
            border-radius: 5px 5px 0 0;
        }
    }

    #course-list-item-grid .card .card-meta-data .meta {
        font-size: 12px;
    }

    #course-list-item-grid .card .card-meta-data h3 {
        padding: 0;
        margin: 0;
        font-weight: 700;
        overflow: hidden;
        max-height: 2.2em;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    #course-list-item-grid .card .card-meta-data .meta-author {
        margin-bottom: 10px;
        display: inline-block;
    }

    #course-list-item-grid h3 {
        font-size: 17px;
    }

    #course-list-item-grid .card .card-content {
        font-size: 0;
    }

    @media (min-width: 768px) {
        #course-list-item-grid .card:not(.card-list-style) .card-content {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }

        #course-list-item-grid .card .card-content {
            font-size: inherit;
        }
    }

    #course-list-item-grid .card-content {
        position: static !important;
    }

    #course-list-item-grid .card-content .image-column {
        float: none;
    }

    #course-list-item-grid .card .image-column {
        display: inline-block;
        vertical-align: top;
        float: none;
        padding: 0;
        font-size: 13px;
    }

    #course-list-item-grid .thumbnail {
        position: relative;
        overflow: hidden;
        height: 120px !important;
    }

    #course-list-item-grid .thumbnail img {
        position: static;
    }

    #course-list-item-grid .thumbnail img {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
    }

    #course-list-item-grid .card img {
        display: block;
        width: 100%;
        height: auto;
        background: #e5e5e5;
        font-size: 0;
        outline: 0;
        vertical-align: middle;
        border: 0;
    }

    #course-list-item-grid img {
        vertical-align: middle;
        border: 0;
    }

    @media only screen and (min-width: 1196px) {
        #course-list-item-grid .card .thumbnail img {
            max-height: 145px;
        }
    }

    @media only screen and (min-width: 1024px) {
        #course-list-item-grid .card .thumbnail img {
            max-height: 119px;
        }
    }

    @media (min-width: 768px) {
        #course-list-item-grid .card .thumbnail img {
            border-radius: 5px 5px 0 0;
        }
    }

    #course-list-item-grid .card-img-top .watch-options {
        display: none;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        color: #fff;
        font-weight: 700;
        background-color: rgba(0, 0, 0, .75);
        z-index: 1;
    }

    #course-list-item-grid .card .card-img-top .watch-options {
        display: block;
        opacity: 0;
        -webkit-transition: opacity .4s ease 0s;
        -o-transition: opacity .4s ease 0s;
        transition: opacity .4s ease 0s;
    }

    #course-list-item-grid .card .card-img-top .watch-options .watch-course {
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        margin-top: 5px;
        width: 100%;
        height: auto;
    }

    #course-list-item-grid .card .card-img-top .watch-options .watch-course:first-child {
        border-right: none;
    }

    @media only screen and (min-width: 768px) {
        #course-list-item-grid .card-img-top .watch-options div {
            width: 100%;
            border: none;
        }
    }

    #course-list-item-grid .card-img-top .watch-options div {
        width: 50%;
        float: left;
        height: 70%;
        position: relative;
        margin-top: 8%;
        text-align: center;
    }

    #course-list-item-grid .card .card-img-top .watch-options .watch-course .icon {
        font-size: 58px;
    }

    /*#course-list-item-grid .lyndacon {*/
    /*    display: inline-block;*/
    /*    font-family: lyndacon;*/
    /*    font-style: normal;*/
    /*    font-weight: 400;*/
    /*    line-height: 1;*/
    /*    -webkit-font-smoothing: antialiased;*/
    /*    -moz-osx-font-smoothing: grayscale;*/
    /*    speak: none;*/
    /*    font-variant: normal;*/
    /*    text-transform: none;*/
    /*}*/


    @media (min-width: 768px) {
        #course-list-item-grid .card .card-meta-data {
            padding: 19px 15px 10px;
            display: block;
            float: left;
        }

        /*#course-list-item-grid .col-sm-12 {*/
        /*    width: 100%;*/
        /*}*/
    }

    /*#course-list-item-grid .col-sm-12 {*/
    /*    min-height: 1px;*/
    /*}*/

    #course-list-item-grid .card .card-meta-data {
        font-weight: 400;
        font-size: 13px;
        line-height: 19px;
        position: relative;
        white-space: normal;
        display: inline-block;
        vertical-align: middle;
        float: none;
    }

    #course-list-item-grid .card a {
        display: block;
    }

    #course-list-item-grid a {
        color: #000;
        text-decoration: none;
        background: transparent;
    }

    .card .card-content .card-img-top .watch-options .watch-course:after {
        content: attr(data-preview-text);
        display: block;
        margin-top: 10px;
    }

    /*#course-list-item-grid a:-webkit-any-link {*/
    /*    color: -webkit-link;*/
    /*    cursor: pointer;*/
    /*    text-decoration: underline;*/
    /*}*/
</style>

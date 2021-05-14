<template>
    <div class="row no-gutters mb-3 list-item-row"
         :onclick="'location.href = \'/courses/' + courseSlug + '/' + courseId + '\';'">
        <div class="col-md-3 align-self-center list-item-img">
            <div class="list-item-img-text align-self-center">
                <a href="#" class="btn-dark p-1">پیش نمایش</a>
            </div>
            <img v-bind:src="courseImg" class="card-img" alt="image">
        </div>
        <div class="col-md-8">
            <div class="card-body py-0">
                <h5 class="card-title"> {{ courseTitle }} <cite class="meta-author">توسط {{ courseAuthor }}</cite>
                </h5>
                <div class="card-text list-item-description">{{ courseDescription }}</div>
                <table class="table table-sm table-borderless badge">
                    <tbody>
                    <tr class="row">
                        <td class="col-md-3 col-sm-6">
                            <span class="ml-2" v-if="!(courseDurationHours === 0 || courseDurationHours === '0')">
                                <i class="skill-level"
                                   v-bind:style="'background-image: url(\'' + courseTimeIcon + '\');'"></i>
                            {{courseDurationHours}} ساعت و {{courseDurationMinutes}} دقیقه
                            </span>
                            <span class="ml-2" v-else>
                                <i class="skill-level"
                                   v-bind:style="'background-image: url(\'' + courseTimeIcon + '\');'"></i>
                            {{courseDurationMinutes}} دقیقه
                            </span>
                        </td>
                        <td class="col-md-3 col-sm-6">
                            <span class="ml-2" v-if="courseSkillLevel === '1'">
                                <i class="skill-level"
                                   v-bind:style="'background-image: url(\'' + courseSkillBeginnerIcon + '\');'"></i>
                                مبتدی
                            </span>
                            <span class="ml-2" v-else-if="courseSkillLevel === '2'">
                                <i class="skill-level"
                                   v-bind:style="'background-image: url(\'' + courseSkillIntermediateIcon + '\');'"></i>
                                متوسط
                            </span>
                            <span class="ml-2" v-else-if="courseSkillLevel === '3'">
                                <i class="skill-level"
                                   v-bind:style="'background-image: url(\'' + courseSkillAdvancedIcon + '\');'"></i>
                                پیشرفته
                            </span>
                            <span class="ml-2" v-else>
                                <i class="skill-level" style="background-image: none;"></i>
                                بدون سطح
                            </span>
                        </td>
                        <td class="col-md-3 col-sm-6">
                            <span class="ml-2">
                                <i class="skill-level"
                                   v-bind:style="'background-image: url(\'' + courseViewsIcon + '\');'"></i>
                                بازدید:  {{ courseViews }}
                            </span>
                        </td>
                        <td class="col-md-3 col-sm-6">
                            <span class="ml-2" data-toggle="tooltip"
                                  v-bind:title="'تاریخ انتشار در لیندا ' + courseReleasedDate">
                                <i class="skill-level"
                                   v-bind:style="'background-image: url(\'' + courseDateIcon + '\');'"></i>
                                تاریخ انتشار:
                                {{ courseCreatedDate }}
                            </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-1 bookmark-icon float-left align-self-center pr-2">
            <img v-bind:src="courseBookmarkCheckSrc"
                 onclick="alert('added')"
                 style="width: 20px;"
                 alt="addto"/>
        </div>
    </div>
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
            courseDescription: null,
            courseDurationHours: null,
            courseDurationMinutes: null,
            courseViews: null,
            courseReleasedDate: null,
            courseCreatedDate: null,
            courseSkillLevel: null,
        },
        methods: {},
        mounted() {

        }
    }
</script>
<style>

    .skill-level {
        width: 16px !important;
        height: 17px !important;
        display: inline-block;
        background-repeat: no-repeat;
        margin-right: 5px;
        vertical-align: middle;
        background-size: contain;
    }

    .meta-author {
        display: inline !important;
        font-size: 14px !important;
    }

    .card-text {
        font-size: 14px !important;
    }

    .list-item-row {
        background-color: rgba(200, 200, 200, 0);
        cursor: pointer;
    }

    .list-item-row:hover {
        background-color: rgba(200, 200, 200, 0.5);

    }

    .bookmark-title {
        font-size: 14px !important;
    }

    .bookmark-icon {
        opacity: 0;

    }

    .list-item-row:hover .bookmark-icon {
        opacity: 1;
        transition-delay: 0s;
        transition-duration: 0.2s;
        cursor: pointer;
    }

    .list-item-img {
        position: relative;
        display: block;
        cursor: pointer;
        overflow: hidden;
        border-radius: 15px;
        transform: scale(.92);
        transition-delay: 0s;
        transition-duration: 0.2s;
    }

    .list-item-row:hover .list-item-img {
        transform: scale(1);
        transition-delay: 0s;
        transition-duration: 0.2s;
    }

    .list-item-img-text {
        opacity: 0;
        position: absolute;
        text-align: center;
        background-color: rgba(50, 50, 50, 0.8);
        transition: all 400ms ease-out;
        width: 100%;
        height: 100%;
    }

    .list-item-row:hover .list-item-img-text {
        opacity: 1;
        transition-delay: 0s;
        transition-duration: 0.2s;
        transform: translateY(50%);
    }

    .list-item-img-text a {
        text-decoration: none;
    }

    .list-item-description {
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        display: -webkit-box !important;
        -webkit-box-orient: vertical !important;
        -webkit-line-clamp: 2 !important;
    }

    span.ml-2 {
        font-size: 12px !important;
    }

</style>

<?php
/**
 * @var array $comments
 */
$this->pageTitle = Yii::app()->name . ' - Comments';
?>
<script type="application/javascript">
    var comments = <?= json_encode($comments)?>;
</script>
<md-content layout-padding>
    <h1>Comments feed</h1>
    <section ng-controller="CommentsController" layout="column" class="comments-wrapper" ng-cloak>
        <md-content ng-if="comments.length > 0" md-scroll-shrink>
            <md-list>
                <md-list-item ng-repeat="item in comments">
                    <md-card class="comment-card" layout-padding="" layout-align="center">
                        <input type="hidden" ng-model="id" value="{{item.id}}">
                        <div class="md-list-item-text" layout="column">
                            <div layout="row" layout-align="space-between center">
                                <div layout="column" layout-align="start start">
                                    <div>
                                        <b>{{ item.author_name }}</b>
                                    </div>
                                    <div>
                                        <small ng-bind="item.create_time | date:'medium'"></small>
                                    </div>
                                </div>
                                <div>
                                    # {{item.id}}
                                </div>
                            </div>
                            <p>{{ item.content }}</p>
                        </div>
                    </md-card>
                </md-list-item>
            </md-list>
        </md-content>
        <md-content ng-if="comments.length === 0">
            <h4>There are no unverified comments.</h4>
        </md-content>
    </section>
</md-content>


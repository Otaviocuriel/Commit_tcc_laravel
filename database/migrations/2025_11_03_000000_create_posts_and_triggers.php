<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePostsAndTriggers extends Migration
{
    
    public function up()
    {
        
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });

        
        Schema::create('posts_audit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id')->nullable();
            $table->string('action'); 
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->unsignedBigInteger('performed_by')->nullable();
            $table->timestamp('performed_at')->useCurrent();
        });

        
        DB::unprepared('DROP TRIGGER IF EXISTS trg_posts_after_insert;');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_posts_after_update;');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_posts_after_delete;');

       
        DB::unprepared("
            CREATE TRIGGER trg_posts_after_insert
            AFTER INSERT ON posts
            FOR EACH ROW
            BEGIN
                INSERT INTO posts_audit (post_id, action, old_values, new_values, performed_by, performed_at)
                VALUES (
                    NEW.id,
                    'INSERT',
                    NULL,
                    JSON_OBJECT(
                        'id', NEW.id,
                        'title', NEW.title,
                        'body', NEW.body,
                        'user_id', NEW.user_id,
                        'created_at', DATE_FORMAT(NEW.created_at, '%Y-%m-%d %H:%i:%s'),
                        'updated_at', DATE_FORMAT(NEW.updated_at, '%Y-%m-%d %H:%i:%s')
                    ),
                    NULL,
                    NOW()
                );
            END;
        ");

        
        DB::unprepared("
            CREATE TRIGGER trg_posts_after_update
            AFTER UPDATE ON posts
            FOR EACH ROW
            BEGIN
                INSERT INTO posts_audit (post_id, action, old_values, new_values, performed_by, performed_at)
                VALUES (
                    NEW.id,
                    'UPDATE',
                    JSON_OBJECT(
                        'id', OLD.id,
                        'title', OLD.title,
                        'body', OLD.body,
                        'user_id', OLD.user_id,
                        'created_at', DATE_FORMAT(OLD.created_at, '%Y-%m-%d %H:%i:%s'),
                        'updated_at', DATE_FORMAT(OLD.updated_at, '%Y-%m-%d %H:%i:%s')
                    ),
                    JSON_OBJECT(
                        'id', NEW.id,
                        'title', NEW.title,
                        'body', NEW.body,
                        'user_id', NEW.user_id,
                        'created_at', DATE_FORMAT(NEW.created_at, '%Y-%m-%d %H:%i:%s'),
                        'updated_at', DATE_FORMAT(NEW.updated_at, '%Y-%m-%d %H:%i:%s')
                    ),
                    NULL,
                    NOW()
                );
            END;
        ");

        
        DB::unprepared("
            CREATE TRIGGER trg_posts_after_delete
            AFTER DELETE ON posts
            FOR EACH ROW
            BEGIN
                INSERT INTO posts_audit (post_id, action, old_values, new_values, performed_by, performed_at)
                VALUES (
                    OLD.id,
                    'DELETE',
                    JSON_OBJECT(
                        'id', OLD.id,
                        'title', OLD.title,
                        'body', OLD.body,
                        'user_id', OLD.user_id,
                        'created_at', DATE_FORMAT(OLD.created_at, '%Y-%m-%d %H:%i:%s'),
                        'updated_at', DATE_FORMAT(OLD.updated_at, '%Y-%m-%d %H:%i:%s')
                    ),
                    NULL,
                    NULL,
                    NOW()
                );
            END;
        ");
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_posts_after_insert;');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_posts_after_update;');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_posts_after_delete;');

        Schema::dropIfExists('posts_audit');
        Schema::dropIfExists('posts');
    }
}

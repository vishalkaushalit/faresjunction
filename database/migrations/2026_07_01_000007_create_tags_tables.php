<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('blog_post_tag', function (Blueprint $table) {
            $table->foreignId('blog_post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->primary(['blog_post_id', 'tag_id']);
        });

        if (Schema::hasColumn('blog_posts', 'tags')) {
            DB::table('blog_posts')
                ->whereNotNull('tags')
                ->select(['id', 'tags'])
                ->orderBy('id')
                ->each(function (object $post): void {
                    $tags = json_decode($post->tags, true);

                    if (! is_array($tags)) {
                        return;
                    }

                    foreach ($tags as $tagName) {
                        $name = trim((string) $tagName);

                        if ($name === '') {
                            continue;
                        }

                        $slug = Str::slug($name);

                        if ($slug === '') {
                            continue;
                        }

                        $tag = DB::table('tags')->where('slug', $slug)->first();
                        $tagId = $tag?->id;

                        if (! $tagId) {
                            $tagId = DB::table('tags')->insertGetId([
                                'name' => $name,
                                'slug' => $slug,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }

                        DB::table('blog_post_tag')->insertOrIgnore([
                            'blog_post_id' => $post->id,
                            'tag_id' => $tagId,
                        ]);
                    }
                });

            Schema::table('blog_posts', function (Blueprint $table) {
                $table->dropColumn('tags');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasColumn('blog_posts', 'tags')) {
            Schema::table('blog_posts', function (Blueprint $table) {
                $table->json('tags')->nullable()->after('excerpt');
            });
        }

        DB::table('blog_posts')
            ->select('id')
            ->orderBy('id')
            ->each(function (object $post): void {
                $tags = DB::table('tags')
                    ->join('blog_post_tag', 'tags.id', '=', 'blog_post_tag.tag_id')
                    ->where('blog_post_tag.blog_post_id', $post->id)
                    ->orderBy('tags.name')
                    ->pluck('tags.name')
                    ->all();

                DB::table('blog_posts')
                    ->where('id', $post->id)
                    ->update(['tags' => $tags ? json_encode($tags) : null]);
            });

        Schema::dropIfExists('blog_post_tag');
        Schema::dropIfExists('tags');
    }
};

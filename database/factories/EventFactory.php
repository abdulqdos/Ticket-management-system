<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = Carbon::now()->addDays(rand(0, 1));
        $endDate = $startDate->copy()->addDays(rand(1, 20));


        return [
            'name' => $this->faker->randomElement([
                "Sahab Tech Solutions",
                "Libyan Web Co.",
                "IT Guys Network",
                "Tripoli Innovations",
                "Cyber Libya"
            ]),
            'description' => $this->faker->randomElement([
                'إقامة بطولة كرة قدم محلية بمشاركة فرق من مختلف الأحياء.',
                'ورشة عمل حول أساسيات البرمجة وتطوير المواقع للمبتدئين.',
                'مهرجان ثقافي يتضمن عروض مسرحية وفقرات موسيقية وشعبية.',
                'سباق دراجات هوائية مفتوح لجميع الأعمار في شوارع المدينة.',
                'ورشة رسم وفنون تشكيلية موجهة للأطفال واليافعين.',
                'معرض كتب محلي يضم دور نشر ومؤلفين شباب.',
                'ورشة تصوير فوتوغرافي لتعليم تقنيات التصوير الاحترافي.',
                'حفل موسيقي خيري لدعم برامج التعليم المجتمعي.',
                'ندوة توعوية حول الصحة النفسية وأثرها على جودة الحياة.',
                'مهرجان أطعمة يضم أطباق تقليدية وعالمية من مطاعم مختلفة.',
            ]),

            'start_date' => $startDate,
            'end_date' => $endDate,
            'location' => $this->faker->address(),
            'company_id' => Company::factory(),
            'city_id' => City::factory(),
        ];
    }
}

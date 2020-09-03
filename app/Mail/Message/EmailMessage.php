<?php

namespace App\Mail\Message;

use Illuminate\Database\Eloquent\Collection;

class EmailMessage implements EmailMessageInterface
{
    protected $copy;
    protected $elements = [];

    protected $subject;
    protected $title;
    protected $featureText;
    protected $safe_button;
    protected $safe_href;

    /**
     * Add the copy to be used in the email with all placeholders filled
     *
     * @param string $file
     * @param array $params
     * @return EmailMessageInterface
     */
    public function setCopy(string $file, array $params = []): EmailMessageInterface
    {
        $this->copy = $this->recursivelyFillTranslations($file, $params);

        return $this;
    }

    /**
     * Add the copy to be used in the email with all placeholders filled
     *
     * @param string $file
     * @param array $params
     * @return EmailMessageInterface
     */
    public function mergeCopy(string $file, array $params = []): EmailMessageInterface
    {
        $translations = $this->recursivelyFillTranslations($file, $params);
        $this->copy = array_merge($this->copy, $translations);

        return $this;
    }
    
    /**
     * Get the subject of the message
     *
     * @return string
     */
    public function subject(): string
    {
        return $this->subject;
    }

    /**
     * Set the subject of the message using the set copy
     *
     * @param string $key
     * @return EmailMessageInterface
     */
    public function setSubject(string $key): EmailMessageInterface
    {
        $this->subject = $this->getCopy($key);

        return $this;
    }

    /**
     * Set the title of the message
     *
     * @param string $key
     * @return EmailMessageInterface
     */
    public function setTitle(string $key): EmailMessageInterface
    {
        $this->title = $this->getCopy($key);

        return $this;
    }

    /**
     * Set the feature text of the email (Text below the title)
     *
     * @param string $key
     * @return EmailMessageInterface
     */
    public function setFeatureText(string $key): EmailMessageInterface
    {
        $this->featureText = $this->getCopy($key);

        return $this;
    }

    /**
     * Add a new section to the email (<hr>)
     *
     * @return EmailMessageInterface
     */
    public function addSection(): EmailMessageInterface
    {
        $this->elements[] = [
            'type' => 'section',
        ];

        return $this;
    }

    /**
     * Add a heading to a section
     *
     * @param string $key
     * @return EmailMessageInterface
     */
    public function addHeading(string $key): EmailMessageInterface
    {
        $text = $this->getCopy($key);

        if (! is_string($text)) {
            throw new \Exception("Email headers must be a string (string $key)");
        }

        $this->elements[] = [
            'type' => 'heading',
            'text' => $text,
        ];

        return $this;
    }

    /**
     * Add some paragraphs to a section
     *
     * @param string $key
     * @return EmailMessageInterface
     */
    public function addParagraphs(string $key): EmailMessageInterface
    {
        $paragraphs = $this->getCopy($key);

        if (! is_array($paragraphs)) {
            throw new \Exception("Email text must be an array of paragraphs (string $key)");
        } else {
            foreach ($paragraphs as $id => $text) {
                if (! is_string($text)) {
                    throw new \Exception("Email text paragraphs must be a string ({$key}.{$id})");
                }
            }
        }

        $this->elements[] = [
            'type' => 'paragraphs',
            'paragraphs' => $paragraphs,
        ];

        return $this;
    }

    /**
     * Add a bulleted list to a section
     *
     * @param string $key
     * @param string $img Images located in images/email/bullets
     * @return EmailMessageInterface
     */
    public function addBullets(string $key, string $img = null): EmailMessageInterface
    {
        $bullets = $this->getCopy($key);

        if (! is_array($bullets)) {
            throw new \Exception("Email bullets must be an array (string $key)");
        } else {
            foreach ($bullets as $id => $text) {
                if (! is_string($text)) {
                    throw new \Exception("An email bullet must be a string ({$key}.{$id})");
                }
            }
        }

        $this->elements[] = $this->makeBullets($bullets, $img);

        return $this;
    }

    /**
     * Insert a bulleted list to a section
     *
     * @param array $bullets
     * @param string $img Images located in images/email/bullets
     * @return EmailMessageInterface
     */
    public function insertBullets(array $bullets, string $img = null): EmailMessageInterface
    {
        foreach ($bullets as $id => $text) {
            if (! is_string($text)) {
                throw new \Exception("An email bullet must be a string ($id)");
            }
        }

        $this->elements[] = $this->makeBullets($bullets, $img);

        return $this;
    }

    /**
     * Add a button to a section, and optionally add a text version at the bottom of the email
     *
     * @param string $key
     * @param string $href
     * @param bool $makeSafeButton
     * @return EmailMessageInterface
     */
    public function addButton(string $key, string $href, bool $makeSafeButton = false): EmailMessageInterface
    {
        $text = $this->getCopy($key);

        if (! is_string($text)) {
            throw new \Exception("Email headers must be a string (string $key)");
        }

        $this->elements[] = [
            'type' => 'button',
            'text' => $text,
            'href' => $href,
        ];

        if ($makeSafeButton) {
            $this->safe_button = $text;
            $this->safe_href = $href;
        }

        return $this;
    }

    /**
     * Add a set of multibullets to a section
     *
     * @param string $key
     * @return EmailMessageInterface
     */
    public function addMultiBullets(string $key): EmailMessageInterface
    {
        $multi = $this->getCopy($key);
        $this->startMultiBullets();
        foreach ($multi as $group) {
            $this->elements[] = $this->makeMultiBullet($group['heading'], $group['img'] ?? null);
            $this->elements[] = $this->makeSubBullets($group['bullets']);
        }
        $this->endMultiBullets();

        return $this;
    }

    /**
     * Add a set of multibullets to a section
     *
     * @param array $multiBullets
     * @return EmailMessageInterface
     */
    public function insertMultiBullets(array $multiBullets): EmailMessageInterface
    {
        $this->startMultiBullets();

        foreach ($multiBullets as $group) {
            $this->elements[] = $this->makeMultiBullet($group['heading'], $group['img'] ?? null);
            $this->elements[] = $this->makeSubBullets($group['bullets']);
        }
        $this->endMultiBullets();

        return $this;
    }

    /**
     * Start a list of multi bullets (Nested Bullets)  in a section
     *
     * @return EmailMessageInterface
     */
    public function startMultiBullets(): EmailMessageInterface
    {
        $this->elements[] = [
            'type' => 'multi-bullets-start',
        ];

        return $this;
    }

    /**
     * Add a top level multi bullet
     *
     * @param string $key
     * @param string $img Images located in images/email/bullets
     * @return EmailMessageInterface
     */
    public function addMultiBullet(string $key, string $img = null): EmailMessageInterface
    {
        $text = $this->getCopy($key);

        if (! is_string($text)) {
            throw new \Exception("Email multi-bullet must be a string (string $key)");
        }

        $this->elements[] = $this->makeMultiBullet($text, $img = null);

        return $this;
    }

    /**
     * Add the nested bullets to a top level bullet
     *
     * @param string $key
     * @param string $img Images located in images/email/bullets
     * @return EmailMessageInterface
     */
    public function addSubBullets(string $key, string $img = null): EmailMessageInterface
    {
        $bullets = $this->getCopy($key);

        if (! is_array($bullets)) {
            throw new \Exception("Email sub-bullets must be an array (string $key)");
        } else {
            foreach ($bullets as $id => $text) {
                if (! is_string($text)) {
                    throw new \Exception("An email bullet must be a string ({$key}.{$id})");
                }
            }
        }

        $this->elements[] = $this->makeSubBullets($bullets, $img);

        return $this;
    }

    /**
     * End the list of multi bullets in a section
     *
     * @return EmailMessageInterface
     */
    public function endMultiBullets(): EmailMessageInterface
    {
        $this->elements[] = [
            'type' => 'multi-bullets-end',
        ];

        return $this;
    }

    /**
     * Return the view associated with this message class
     *
     * @return string
     */
    public function view(): string
    {
        return 'emails.message-builder';
    }

    /**
     * Return the variables necessary to build the messages view
     *
     * @return array
     */
    public function vars() : array
    {
        if (empty($this->subject)) {
            throw new \Exception("Cannot create an email with an empty subject");
        }

        if (empty($this->title)) {
            throw new \Exception("Cannot create an email with an empty title");
        }

        if (empty($this->featureText)) {
            throw new \Exception("Cannot create an email with empty feature text");
        }

        $vars = [
            'subject' => $this->subject,
            'title' => $this->title,
            'featureText' => $this->featureText,
            'elements' => $this->elements,
        ];

        if ($this->safe_button && $this->safe_href) {
            $vars['safe_button'] = $this->safe_button;
            $vars['safe_href'] = $this->safe_href;
        }

        return $vars;
    }

    /**
     * Make a bullets element
     *
     * @param Collection|array $bullets
     * @param string $img
     * @return array
     */
    protected function makeBullets($bullets, string $img = null) : array
    {
        return [
            'type' => 'bullets',
            'bullets' => $bullets,
            'img' => 'images/email/bullets/'. ($img ?? 'arrow-bullet.png'),
        ];
    }

    /**
     * Make a multibullet element
     *
     * @param string $text
     * @param string|null $img
     * @return array
     */
    protected function makeMultiBullet(string $text, string $img = null)
    {
        return [
            'type' => 'multi-bullet',
            'text' => $text,
            'img' => 'images/email/bullets/'. ($img ?? 'arrow-bullet.png'),
        ];
    }

    /**
     * Make a sub bullets element for multi bullets
     *
     * @param array $bullets
     * @param string|null $img
     * @return array
     */
    protected function makeSubBullets(array $bullets, string $img = null)
    {
        return [
            'type' => 'sub-bullets',
            'bullets' => $bullets,
            'img' => 'images/email/bullets/'. ($img ?? 'arrow-bullet.png'),
        ];
    }

    /**
     * Fill all placeholders in an array of translations
     *
     * @param string $file
     * @param array $params
     * @return array
     */
    protected function recursivelyFillTranslations(string $file, array $params = [])
    {
        $translated = [];
        $keys = array_keys(__($file));

        foreach ($keys as $key) {
            $trans = __("$file.$key", $params);

            if (is_array($trans)) {
                $translated[$key] = [];
                $translated[$key] += $this->recursivelyFillTranslations($file.'.'.$key, $params);
            } else {
                $translated[$key] = $trans;
            }
        }

        return $translated;
    }

    /**
     * Helper function to get a translation from dot notation ie 'user.first_name'
     *
     * @param string $key
     * @return string|array
     */
    protected function getCopy(string $key)
    {
        $keys = explode('.', $key);
        
        $k = array_shift($keys);
        $copy = $this->copy[$k];

        while (! empty($keys)) {
            $k = array_shift($keys);
            $copy = $copy[$k];
        }

        if (empty($copy)) {
            throw new \Exception("No copy found for ($key)");
        }

        return $copy;
    }
}

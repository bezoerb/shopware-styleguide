{extends file="frontend/styleguide/section.tpl"}

{block name="frontend_styleguide_section_title"}
  {block name="frontend_styleguide_base_forms_title"}
    {s name="headline" namespace="frontend/styleguide/base/forms"}Forms{/s}
  {/block}
{/block}

{block name="frontend_styleguide_section_description"}
  {block name="frontend_styleguide_base_forms_copy"}
    {s name="copy" namespace="frontend/styleguide/base/forms"}{/s}
  {/block}
{/block}

{block name="frontend_styleguide_section_content"}
  {block name="frontend_styleguide_base_forms_content"}
    {block name="frontend_styleguide_base_forms_content_input"}
      {styleguide_html}
        <label for="input">Example input</label>
        <br/>
        <input type="text" id="input" placeholder="Example input">
      {/styleguide_html}
    {/block}

    {block name="frontend_styleguide_base_forms_content_select"}
      {styleguide_html}
        <label for="select">Example select</label>
        <br/>
        <select id="select">
          <option value="">Choose...</option>
          <optgroup label="Option group 1">
            <option value="">Option 1</option>
            <option value="">Option 2</option>
            <option value="">Option 3</option>
          </optgroup>
          <optgroup label="Option group 2">
            <option value="">Option 4</option>
            <option value="">Option 5</option>
            <option value="">Option 6</option>
          </optgroup>
        </select>
      {/styleguide_html}
    {/block}

    {block name="frontend_styleguide_base_forms_content_checkbox"}
      {styleguide_html}
        <label>
          <input type="checkbox" value="">
          Check this checkbox
        </label>
        <br/>
        <label>
          <input type="checkbox" value="" disabled>
          This checkbox is disabled
        </label>
      {/styleguide_html}
    {/block}

    {block name="frontend_styleguide_base_forms_content_radio"}
      {styleguide_html}
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
          Option one
        </label>
        <br/>
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
          Option two
        </label>
        <br/>
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" disabled>
          Option three is disabled
        </label>
      {/styleguide_html}
    {/block}

    {block name="frontend_styleguide_base_forms_content_textarea"}
      {styleguide_html}
        <label for="textarea">Example textarea</label>
        <br/>
        <textarea id="textarea" rows="3"></textarea>
      {/styleguide_html}
    {/block}

    {block name="frontend_styleguide_base_forms_content_date"}
      {styleguide_html}
        <label for="date">Example date</label>
        <input type="date" id="date">
      {/styleguide_html}
    {/block}

    {block name="frontend_styleguide_base_forms_content_time"}
      {styleguide_html}
        <label for="time">Example time</label>
        <input type="time" id="time">
      {/styleguide_html}
    {/block}

    {block name="frontend_styleguide_base_forms_content_submit"}
      {styleguide_html}
        <button class="btn" type="submit">Button submit</button>
        <input class="btn" type="submit" value="Input submit button">
        <input class="btn" type="button" value="Input button">
        <br>
        <button class="btn" type="submit" disabled="">Button submit</button>
        <input class="btn" type="submit" value="Input submit button" disabled="">
        <input class="btn" type="button" value="Input button" disabled="">
      {/styleguide_html}
    {/block}
  {/block}
{/block}
